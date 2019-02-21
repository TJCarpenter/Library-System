import names
import csv
from random import randint
from faker import Faker
fake = Faker()

# Settings
debug =              1              # If set to 1, script will print a result of what it created
_FILE =             "Members.csv"   # Sets the file to enter the results into
num_to_generate =   1000            # Sets the number of results to generate


for i in range(1, num_to_generate):

    # Member First name and Last Name
    first_name = names.get_first_name()
    last_name = names.get_last_name()

    # Member address
    member_address = fake.address()
    state = member_address.split(" ")[-2]
    
    while (state != "TX"):
        member_address = fake.address()
        state = member_address.split(" ")[-2]

    member_address = member_address.split("\n")
    
    street_number = member_address[0].split(" ")[0]
    street_name = " ".join(member_address[0].split(" ")[1:])
    
    second_part = member_address[1].split(",")
    city = second_part[0]
    zip_code = second_part[1].split(" ")[2]

    member_address = " ".join(member_address)

    #print("Address[\n\tStreet Number: {}\n\tStreet Name: {}\n\tCity: {}\n\tState: {}\n\tZip Code: {}\n]".format(street_number, street_name, city, state, zip_code))
    
    # Member phonenumber
    member_phone_number = "(" + str(randint(1,9)) + str(randint(0,9)) + str(randint(0,9)) + ")-" + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + "-" + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9))

    # Generate Memeber ID and Member PIN
    member_id = str(randint(1,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9))
    member_pin = str(randint(1,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9))
    
    # Formulate Row
    row = [first_name, last_name, street_number, street_name, city, state, zip_code, member_id, member_pin]

    # Debug
    if debug == 1:
        print("First Name: {}\nLast Name: {}\nAddress: {}\nPhone Number: {}\nID: {}\nPIN: {}\n".format(first_name, last_name, member_address, member_phone_number, member_id, member_pin))


    # Add to CSV file
    with open(_FILE, 'a', newline='') as file:
        writer = csv.writer(file, delimiter=',')
        writer.writerows([row])

file.close()
    







    
    

