# Music-Academy-Management-System
FYP System

## Setup
- Install [XAMPP](https://www.apachefriends.org/download.html) 
- Open phpMyAdmin
- Create a new database as music_academy
- Import the database using the `music_academy.sql` file from sql folder
- All dummy user password are 123, can use [md5 online decrypt](https://www.md5online.org/md5-decrypt.html) to check
- Can create your own new admin user by manually add new admin in admin table

### Environment Setup
create `.env` file, copy the things  from `.env.example`, and put any email you want for phpmailer, public and secret key for stripe

## Features
### Admin
- Login
- Forgot password
- Edit profile
- Notification
- Add/Edit/Delete class
- Edit class attendance
- Add/Edit teacher
- Add/Edit parent
- Edit invoice
- Add/Edit payment receipt

### Teacher
- Login
- Forgot password
- Edit profile
- Notification
- Add/Edit/Delete class
- Edit class attendance
- Accept/Reject class reschedule request from parent
- View child list
- Add/Edit/Delete learning resource
- Add/Edit/Delete child practice progress
- Add/Delete comment

### Parent
- Login
- Forgot password
- Edit profile
- Notification
- View class
- Add class reschedule request
- View child list
- View course detail
- View teacher list
- View invoice
- Make online payment (Stripe)
- Add payment receipt
- View learning resource
- View child practice progress
- Add/Delete comment


### Notes
- phpmailer setup must be done for features such as Forgot password, Admin add teacher and add parent
