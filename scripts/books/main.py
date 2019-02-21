from bs4 import BeautifulSoup as bs
import requests
from random import randint, choice
import names
import csv
import time


for i in range(1, 10000):

    time.sleep(3)
    
    # URL
    url = 'https://booktitlegenerator.com/'

    # Request the URL
    r = requests.get(url)

    # Process the data
    soup = bs(r.text, 'html.parser')

    li = soup.findAll('li')

    author_list = [] # Generates a list of authors an n number of times based on the number of book they have made

    auth = 0

    for elem in li:

        # Generate Authors
        if len(author_list) == 0:
            while len(author_list) <= len(li):
                num_books = randint(1,7) # An author can have 1 to 7 books
                author = names.get_full_name()
                
                for j in range(num_books):
                      author_list.append(author)

            for k in range(len(author_list) - len(li)):
                author_list.pop()
        
        # Title
        title = elem.text #  Extracts the titles from the page

        # ISBN creation
        isbn_len = 10 # Based on ISBN-10
        
        first_sec = str(randint(0,1)) # First part can be either a 1 or a 0
        isbn_len -= 1 # Remove 1 from the total length of the ISBN number

        secod_sec_len = randint(3,7) # The second part can be between 3 and 7 numbers in length
        second_sec = str(randint(int('1' + (secod_sec_len-1)*'0'), int('9' + (secod_sec_len-1)*'9'))) # Generates a number based on the length of the second_sec_len
        isbn_len -= len(second_sec) # Removes the length of the section of the total ISBN number length

        third_sec = str(randint(int('1' + (isbn_len-2)*'0'), int('9' + (isbn_len-2)*'9'))) # The third part is based on the previous section
        isbn_len -= len(third_sec) # Removes the length of the section of the total ISBN number

        fourth_sec = str(randint(0, 9)) # The last number is a single digit and can be between 0 and 9
        
        isbn = first_sec + '-' + second_sec + '-' + third_sec + '-' + fourth_sec # Puts all of the ISBN sections together to generate a custom ISBN number for a book

        # Author creation
        author = author_list[auth] # Select the next author on the list

        # Publisher
        publisher_co = ['Simon Wallenberg Press', 'Scribner', 'Frederick Ungar', 'J.A. Allen & Co.', 'Willmann–Bell', 'KT Publishing']
        publisher = publisher_co[randint(0, len(publisher_co)-1)] # Selects a random publisher from the list

        # Publisher Date
        published_dates_list = [randint(1920, 1940)]*10 + [randint(1941, 1970)]*15 + [randint(1971, 1990)]*25 + [randint(1991,2018)]*50
        published_months = ['01','02','03','04','05','06','07','08','09','10','11','12']
        published_month = choice(published_months)
        
        if published_month == '01':
            published_day = str(randint(1, 31)) # January
        elif published_month == '02':
            published_day = str(randint(1, 28)) # Febuary
        elif published_month == '03':
            published_day = str(randint(1, 31)) # March
        elif published_month == '04':
            published_day = str(randint(1, 30)) # April
        elif published_month == '05':
            published_day = str(randint(1, 31)) # May
        elif published_month == '06':
            published_day = str(randint(1, 30)) # June
        elif published_month == '07':
            published_day = str(randint(1, 31)) # July
        elif published_month == '08':
            published_day = str(randint(1, 31)) # August
        elif published_month == '09':
            published_day = str(randint(1, 30)) # September
        elif published_month == '10':
            published_day = str(randint(1, 31)) # October
        elif published_month == '11':
            published_day = str(randint(1, 30)) # November
        elif published_month == '12':
            published_day = str(randint(1, 31)) # December

        if len(published_day) == 1:
            published_day = '0' + published_day
            
        published_date = str(choice(published_dates_list)) + '-' + published_month + '-' + published_day   

        # Formulate Row
        row = [title, author, isbn, publisher, published_date]

        auth += 1

        #print('Title: {}\nAuthor: {}\nISBN: {}\nPublisher: {}\nPublished Date: {}\n'.format(title, author, isbn, publisher, published_date))
        
        with open('Books.csv', 'a', newline='') as file:
            writer = csv.writer(file, delimiter=',')
            writer.writerows([row])
    #print("[{}] Collection Finished".format(i))
file.close()
    







    
    

