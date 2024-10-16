# The Event

**The Event** is an event management system built with PHP and the Laravel framework, utilizing the Livewire library. It allows users to create and manage events, choose venues, and book tickets with different pricing classes.

## Key Features

- **User Roles**: Three different user roles (admin, organizer, customer).
- **Event Creation**: Organizers and admins can create events that are displayed on the event page.
- **Venue Selection**: Organizers can choose from various venues when creating events.
- **Ticket Booking**: Customers can browse upcoming events and book tickets from different classes that vary in price.
- **User Management**: Users must sign up to book tickets. New users are assigned the admin role by default, and an admin can change a user's role to organizer.

## Installation Instructions

To set up **The Event** on your local machine, follow these steps:

1. Ensure you have the following installed:
   - PHP version: 8.2
   - Laravel version: 10

2. Install the project dependencies:
   ```
   composer install
   npm install

3. Create a .env file based on the .env.example file provided in the repository.
 
5. Generate the application key:
   ```
   php artisan key:generate

6. Install livewire:
   ```
   composer require livewire/livewire

7.Run the migrations to set up the database:
   ```
   php artisan migrate
   ```

## Usage

- Users must sign up to book tickets. New users are assigned the admin role by default.
- To become an organizer, an admin must change a user's role.
- Organizers and admins can create events that will be displayed on the event page.
- Customers can view only upcoming events and can book tickets from different classes for those events.

## Contributing

Currently, **The Event** is maintained by a team of four contributors. External contributions are not accepted.

## License

This project does not have a formal license.
