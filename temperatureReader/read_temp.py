import os
import display
import time
import mysql.connector
import datetime

def insertTemp(tempValue):
    cnx = mysql.connector.connect(user='root',password='dibie33',host="localhost",database='test')
    mycursor = cnx.cursor()
    sql = "INSERT INTO temp_readings (time,temp) VALUES (%s,%s)"
    now = datetime.datetime.now()
    curdatetime =  now.strftime("%Y-%m-%d %H:%M:%S")

    val = (curdatetime,tempValue)
    mycursor.execute(sql,val)

    cnx.commit()

def get_temp(fName):
    # check to see if file exist
   # value = -1;
    if os.path.exists(fName):
        with open(fName, 'r') as f:
            try:
                first_line = f.readline().strip();
                # check to see if correct temp value was read
                isyes = first_line.split()[-1];
                if(isyes == "YES"):
                    #get temperature value
                    second_line = f.readline().strip();
                    temp = second_line.split()[-1][2:];
                    value = float(temp)/1000;
                    #print(value)

            except:
                print("There  was an error while reading the file");
        
    else:
        print("File does not exist");

    return value
def main():
    temp_file = "/sys/bus/w1/devices/28-000008d5f883/w1_slave"
    display.setI2CDisplay()
    while(1):
	    temperature = get_temp(temp_file)
        display.printValue(temperature)
	    insertTemp(temperature)
        time.sleep(300);

main()


