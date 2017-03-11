#!/usr/bin/python
##
# @file
# script to log via MQTTPUB generated MQTT messages into database
#
# to run adjust credentials first
#
# @author
# @date 2017-03-11
# @version 0.2
# @copyright Thomas Dressler 2016-2017
#
# How to use:
# - create mysql account and database.
# - Grant "Create table, Insert,update,delete,index " or simple "All" on database
# - check if you can connect
# - create a YAML file 'ips_mqtt2db.yml' with the needed credentials and adjust the values.
#   @code
# mysql:
#    host: localhost
#    user: ips
#    passwd: secret
#    db: ips
# mqtt:
#  host: localhost
#  port: 1883
#  topic: IPS/status/#
#   @endcode
#
# - install required additional pip libraries:
#   @code
#  paho_mqtt
#  MySQL-python (python2)/ PyMySQL (python3)
#  PyYAML
#   @endcode

# - now call the script
#   @code
# python ips_mqtt2db.py 'configfilename'
#   @endcode
#   or if the configfile is named ips_mqtt2db.yml and in the same directory
#  @code
# python ips_mqtt2db.py
#  @endcode
#


import sys
import warnings
import paho.mqtt.client as mqtt
import json
import datetime
import platform
import codecs
import yaml

try:
    import MySQLdb as mysql  # python2
except:
    import pymysql as mysql  # python3

# my filename
me = sys.argv[0]


##
# retrieves the filename without extension
# @param path Filename
# @return string
def getFileNameWithoutExtension(path):
    return path.split('\\').pop().split('/').pop().rsplit('.', 1)[0]


##
# read config from yom file
#
def read_config():
    try:
        cfgfile = sys.argv[1]
    except:
        cfgfile = getFileNameWithoutExtension(me) + ".yml"
    try:
        with open(cfgfile, 'r') as ymlfile:
            cfg = yaml.load(ymlfile)
            return cfg
    except:
        # not open
        print("Cannot read config file " + cfgfile)
        sys.exit(1)


##
# process paho mqtt connect event
# @param client
# @param userdata
# @param flags
# @param rc


def on_connect(client, userdata, flags, rc):
    client.subscribe(base_topic)
    print ("subscribed to '%s' on '%s:%s' " % (base_topic, mqttcfg['host'], mqttcfg['port']))


##
# process incoming paho mqtt message event
# @param client
# @param userdata
# @param msg payload
#
# expected payload json data format:
# @code
# {'Path': 'APCUPSD Devices/Back-UPS RS 900G/Load',
# 'TS': 1476977860,
# 'UTF8Value': '25',
# 'VariableChanged': 1476977860,
# 'VariableID': 10899,
# 'VariableIdent': 'LoadPct',
# 'VariableType': 1,
# 'VariableUpdated': 1476977860}
# @endcode


def on_message(client, userdata, msg):
    # #print(msg.topic + " " + str(msg.payload))
    # Split handler and command
    topic = msg.topic
    t = topic.split('/')

    if t[1] != "status": return
    data = []
    if len(msg.payload) > 0:
        try:
            data = json.loads(msg.payload.decode("utf-8"))
        except ValueError as e:
            print("Unable to parse json data: '%s'" % str(e))
            return

    if type(data) is dict:
        ts = data.get('VariableChanged', '0')
        dt = datetime.datetime.fromtimestamp(ts)
        datum = dt.strftime('%Y-%m-%d %H:%M:%S')
        var_id = data.get('VariableID')
        var_ident = data.get('VariableIdent', '')
        var_type = data.get('VariableType', '0')
        value = data.get('UTF8Value', '')
        path = data.get('Path', '')
        print ('%s,%05d,"%s",%d,"%s","%s",%d' % (datum, var_id, var_ident, var_type, path, value, ts))
        try:
            cursor.execute(sql, (datum, var_id, var_ident, var_type, path, value))
            conn.commit()
        except mysql.IntegrityError as e:
            conn.rollback()
            pass
        except mysql.Error as e:
            print("Unable to insert data: '%s'" % str(e))
            conn.rollback()
            pass


# mysql credentials
cfg = read_config()
mysqlcfg = cfg['mysql']
# mqtt credentials
mqttcfg = cfg['mqtt']
# topic
base_topic = mqttcfg['topic']

# os
myhostname = platform.node()
os = platform.system()
# fix output
# http://chase-seibert.github.io/blog/2014/01/12/python-unicode-console-output.html
if os != "Windows":
    sys.stdout = codecs.getwriter('utf8')(sys.stdout)
    sys.stderr = codecs.getwriter('utf8')(sys.stderr)

# mysql connect
warnings.filterwarnings('ignore', category=mysql.Warning)
try:
    conn = mysql.connect(mysqlcfg['host'], mysqlcfg['user'], mysqlcfg['passwd'], mysqlcfg['db'])
    # #print ("Connected to Host '%s' User '%s' @ DB '%s'"% (mysqlcfg['host'], mysqlcfg['user'], mysqlcfg['db']))
    # #with conn:
    cursor = conn.cursor()
    # #cursor.execute('drop table if exists ips')
    cursor.execute('''CREATE TABLE IF NOT EXISTS ips (
                        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                        last_change DATETIME(0),
                        VariableID INTEGER,
                        VariableIdent VARCHAR(50),
                        VariableType INTEGER,
                        path VARCHAR(255),
                        value TEXT,
                        PRIMARY KEY (id),
                        UNIQUE KEY last_change_unq (variableID,last_change)
                      )''')
    # prepare insert sql
    sql = 'INSERT INTO ips (last_change, VariableID, VariableIdent,VariableType,path,value) VALUES (%s,%s,%s,%s,%s,%s)'
except:
    print ("Database Error Host '%s' User '%s' @ DB '%s'" % (mysqlcfg['host'], mysqlcfg['user'], mysqlcfg['db']))
    sys.exit(1)

# mqtt settings
mqtt_clientID = getFileNameWithoutExtension(me) + '@' + myhostname
client = mqtt.Client(mqtt_clientID)
client.on_connect = on_connect
client.on_message = on_message

# mqtt connect
client.connect(mqttcfg['host'], mqttcfg['port'], 60)

# main loop forever
client.loop_forever()
