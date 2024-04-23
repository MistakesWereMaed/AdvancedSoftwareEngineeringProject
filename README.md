# AdvancedSoftwareEngineeringProject

This PHP web application facilitates the process of importing data from a CSV file into a MySQL database. It provides error logging, error tracking, and validation features to ensure smooth data import. Additionally, it includes functionality to create, modify, and view equipment data through a set of API endpoints, both for the web interface and for external sites.

## Note
This project is still currently being completed: the documentation and external website will be finished within the week (as of 4/23/2024).

## Features

- **CSV Import:** Allows users to upload large CSV files containing data to be imported into the MySQL database.
- **Error Handling:** Logs encountered errors during the import process and keep track of error types and line numbers.
- **Database Integration:** Imports valid data into the MySQL database while tracking and managing erroneous data for later validation.
- **API Endpoints:** Provides a set of API endpoints to replicate web functionalities, ensuring seamless integration with external sites.
- **Logging:** Logs all API and web endpoint calls, including the source of the call, timestamp, the endpoint called, and the result of the call, ensuring comprehensive tracking and monitoring of system activity.
- **Endpoint Documentation:** Detailed documentation of API endpoints with input parameters, expected outputs, and error messages.
- **Nginx Configuration:** Properly configured Nginx server to accommodate API endpoints.

## Web Endpoints

### Search
- **Endpoint:** `/web/search`
- **Functionality:** Search for equipment by device type, manufacturer, or serial number.
- **Additional Features:** Option to include inactive equipment, limits results to 1000 records.

### Add Equipment
- **Endpoint:** `/web/add_equipment`
- **Functionality:** Add new equipment, with the ability to add a new device or manufacturer.

### Modify Equipment
- **Endpoint:** `/web/modify_equipment`
- **Functionality:** Update device type, manufacturer, serial number, or availability status of equipment.

### View Equipment
- **Endpoint:** `/web/view_equipment`
- **Functionality:** View details of a single equipment entry, including device name, manufacturer name, serial number, and status.

## API Endpoints

### Add New Equipment
- **Endpoint:** `/api/add_equipment`
- **Functionality:** Add new equipment with proper error checking and status messages.

### Add New Device
- **Endpoint:** `/api/add_device`
- **Functionality:** Add a new device with error checking and appropriate messages.

### Add New Manufacturer
- **Endpoint:** `/api/add_manufacturer`
- **Functionality:** Add a new manufacturer with error handling and status messages.

### Search for Equipment
- **Endpoint:** `/api/search_equipment`
- **Functionality:** Search for equipment with options for device type, manufacturer, serial number, and availability status.

### View Single Equipment Entry
- **Endpoint:** `/api/view_equipment`
- **Functionality:** View details of a single equipment entry with appropriate error messages.

### Modify Equipment
- **Endpoint:** `/api/modify_equipment`
- **Functionality:** Modify equipment details such as device type, manufacturer, serial number, or availability status.

### Modify Device
- **Endpoint:** `/api/modify_device`
- **Functionality:** Modify device details including name and availability status.

### Modify Manufacturer
- **Endpoint:** `/api/modify_manufacturer`
- **Functionality:** Modify manufacturer details including name and availability status.

### API Documentation
- **Documentation:** Detailed documentation of all API endpoints with required parameters, expected outputs, and error handling.

## External Site

An external site replicates the functionality and interface of the web endpoints using API calls. It includes features to view, search, add new device/manufacturer/equipment, and update availability of device/manufacturer/equipment.

## Nginx Configuration

Nginx server is properly configured to accommodate API endpoints with appropriate error handling and status messages.

---
