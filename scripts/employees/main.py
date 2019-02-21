import names
import csv
from random import randint, choice
from faker import Faker
fake = Faker()

# Settings
debug =              1              # If set to 1, script will print a result of what it created
_FILE =             "Employees.csv" # Sets the file to enter the results into
num_to_generate =   20              # Sets the number of results to generate

for i in range(1, num_to_generate):

    if i <= 3:
        # Employee Title
        employee_title = "Manager"
            
        # Give Employee Access
        employee_admin_access = True
        employee_records_access = True
        employee_books_access = True

        employee_book_edit_access = True
        employee_records_edit = True

        # Salary
        employee_salary = randint(60000, 80000)
    elif i >= 4 and i <= 7:
        # Employee Title
        employee_title = "Library Director"
            
        # Give Employee Access
        employee_admin_access = False
        employee_records_access = True
        employee_books_access = True

        employee_book_edit_access = True
        employee_records_edit = True

        # Salary
        employee_salary = randint(40000, 50000)
        
    elif i >= 8 and i <= 14:
        # Employee Title
        employee_title = "Librarian"
            
        # Give Employee Access
        employee_admin_access = False
        employee_records_access = True
        employee_books_access = True

        employee_book_edit_access = True
        employee_records_edit = False

        # Salary
        employee_salary = randint(30000, 40000)
        
    else:
        # Employee Title
        employee_title = "Library Assistant"
            
        # Give Employee Access
        employee_admin_access = False
        employee_records_access = True
        employee_books_access = True

        employee_book_edit_access = False
        employee_records_edit = False

        # Salary
        employee_salary = randint(10000, 20000)



    # Employee First name and Last Name
    first_name = names.get_first_name()
    last_name = names.get_last_name()

    # Employee address
    employee_address = fake.address()
    state = employee_address.split(" ")[-2]
    
    while (state != "TX"):
        employee_address = fake.address()
        state = employee_address.split(" ")[-2]

    employee_address = employee_address.split("\n")
    
    street_number = employee_address[0].split(" ")[0]
    street_name = " ".join(employee_address[0].split(" ")[1:])
    
    second_part = employee_address[1].split(",")
    city = second_part[0]
    zip_code = second_part[1].split(" ")[2]

    employee_address = " ".join(employee_address)

    #print("Address[\n\tStreet Number: {}\n\tStreet Name: {}\n\tCity: {}\n\tState: {}\n\tZip Code: {}\n]".format(street_number, street_name, city, state, zip_code))
    
    # Employee phonenumber
    employee_phone_number = "(" + str(randint(1,9)) + str(randint(0,9)) + str(randint(0,9)) + ")-" + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + "-" + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9))

    # Generate Employee Badge ID and Employee PIN
    employee_badge_id = str(randint(1,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9)) + str(randint(0,9))

    # Formulate Row
    row = [first_name, last_name, employee_title, employee_badge_id, street_number, street_name, city, state, zip_code, employee_phone_number, employee_admin_access, employee_records_access, employee_books_access, employee_book_edit_access, employee_records_edit]

    # Debug
    if debug == 1:
        print("First Name: {}\nLast Name: {}\nTitle: {}\nBadge Number: {}\nSalary: ${}\nAddress: {}\nPhone Number: {}".format(first_name, last_name, employee_title, employee_badge_id, employee_salary, employee_address, employee_phone_number))
        print("Access:\n\tAdmin: {}\n\tRecords: {}\n\tBooks: {}\nEdit:\n\tBooks: {}\n\tRecords: {}\n".format(employee_admin_access, employee_records_access, employee_books_access, employee_book_edit_access, employee_records_edit))

    # Add to CSV file
    with open(_FILE, 'a', newline='') as file:
        writer = csv.writer(file, delimiter=',')
        writer.writerows([row])

file.close()
    







    
    

