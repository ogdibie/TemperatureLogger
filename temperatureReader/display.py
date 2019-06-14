#!/usr/bin/python
from smbus2 import SMBusWrapper
import os
import time
SLAVE_ADDRESS = 0x70; #address of the LED Display

def setI2CDisplay():
    #bus = SMBus(1)  #open i2c bus 1
    #create buffer used in setting up i2c display
    data = [0] * 16; #buffer of 17

    with SMBusWrapper(1) as bus:
        # turn on oscillator
        on_osci = (0x2 << 4) | 0x01; #set upper 4 bit 0x02 and lower 4 bits 0x01
        #data[0] = on_osci
        bus.write_byte_data(SLAVE_ADDRESS,on_osci,0)

        #turn on Display, No Blink
        cmd = (0x08 << 4) | 0x01;
        #data[0] = cmd;
        bus.write_byte_data(SLAVE_ADDRESS,cmd,0);

        #set brightness

        cmd = (0x0E << 4) | 0x0E # set brightness by adjusting the duty cycle (15/16)
        #data[0] = cmd;
        bus.write_byte_data(SLAVE_ADDRESS,cmd,0);
        
        #data[0] = 0x79;
        #data[2] = 0x39;
        #data[3] = 0x00;
        #data[6] = 0x79;
        #data[8] = 0x79
        bus.write_i2c_block_data(SLAVE_ADDRESS,0,data);
def printValue(number):
    buffer = [0] * 16 #data used in printing display
    if number >= 0 and number <= 99.9:
        str_temp = str(round(number,1))
        temp_split = str_temp.split(".");
        # single digit case
        if number < 10:
          buffer[0] = mapChar(temp_split[0]) 
          buffer[0] |= 0x80 # .
          buffer[2] = mapChar(temp_split[1])
          buffer[6] = 0x63 # degree
        else:
        #2 digit in the whole number 10.x....99.9
          buffer[0] = mapChar(temp_split[0][0]) 
          buffer[2] = mapChar(temp_split[0][1])
          buffer[2] |= 0x80 #.
          buffer[6] = mapChar(temp_split[1])
          buffer[8] = 0x63

    elif number >= 100 and number < 999:
        str_temp = str(round(number,1)).split(".")
        buffer[0] = mapChar(str_temp[0][0]) 
        buffer[2] = mapChar(str_temp[0][1])
        buffer[6] = mapChar(str_temp[0][2])
        buffer[8] = 0x63
    elif number >= -99.9 and number < 0:
        str_temp = str(round(number,1))
        temp_split = str_temp.split(".");
        # single digit case -7.2...
        if number > -10:
          buffer[0] = 0x40 # - 
          buffer[2] = mapChar(temp_split[0][1]) # .
          buffer[2] |= 0x80
          buffer[6] = mapChar(temp_split[1][0])
          buffer[8] = 0x63 # degree
        else:
        #2 digit in the whole number -99 degree
          buffer[0] = 0x40 # - 
          buffer[2] = mapChar(temp_split[0][1]) # .
          buffer[6] = mapChar(temp_split[0][2]) 
          buffer[8] = 0x63 # degree
    else:
        buffer[0] = 0x71
        buffer[2] = 0x31
        buffer[6] = 0x31
        #invalid case
    #write out data
    with SMBusWrapper(1) as bus:
        bus.write_i2c_block_data(SLAVE_ADDRESS,0,buffer)

def mapChar(digit):
    digit = int(digit)
    result = 0
    if digit == 1:
        result = 0x06
    
    elif digit == 2:
        result = 0x5B

    elif digit == 3:
        result = 0x4F

    elif digit == 4:
        result = 0x66

    elif digit == 5:
        result = 0x6D

    elif digit == 6:
        result = 0x7D

    elif digit == 7:
        result = 0x07

    elif digit == 8:
        result = 0x7F

    elif digit == 9:
        result = 0x6F

    elif digit == 0:
        result = 0x3F
    return result


