#!/bin/bash
mysql -ujuyishop -pM5mmK6JTtCyNkBMf juyishop -e "delete from jy_setappointment where appointdate < date_sub(curdate(),interval 60 day)"
