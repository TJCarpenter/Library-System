import names
import csv
from random import randint

# Settings
debug =              1              # If set to 1, script will print a result of what it created
_FILE =             "Members.csv"   # Sets the file to enter the results into
num_to_generate =   1000            # Sets the number of results to generate


for i in range(1, num_to_generate):

    # Member First name and Last Name
    first_name = names.get_first_name()
    last_name = names.get_last_name()

    # Generate Memeber ID and Member PIN
    member_id = str(randint(1,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9))
    member_pin = str(randint(1,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9))
    
    # Formulate Row
    row = [first_name, last_name, member_id, member_pin]

    # Debug
    if debug == 1:
        print("First Name: {}\nLast Name: {}\nID: {}\nPIN: {}\n".format(first_name, last_name, member_id, member_pin))


    # Add to CSV file
    with open(_FILE, 'a', newline='') as file:
        writer = csv.writer(file, delimiter=',')
        writer.writerows([row])

file.close()
    







    
    

