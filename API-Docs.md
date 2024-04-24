URL: https://ec2-18-224-246-127.us-east-2.compute.amazonaws.com:8080/api/ENDPOINT
Add: 
Add_device:
Parameters: 
(String) device: d_name
ENDPOINT: 
add_device?device=d_name
Return Values:
(Message string) ‘Device added successfully.’
Status: SUCCESS
Action: None
(Message string) ‘Missing device name.’
Status: ERROR
Action: None
Cause: d_name was not set
(Message string) ‘Device already exists in database.’
Status: ERROR
Action: list_devices
Cause: a device with d_name is already present in the database
(Message string) ‘QUERY_FAILED: $message.’
Status: ERROR
Action: None
Cause: SQL query failed
add_manufacturer:
Parameters: 
(String) manufacturer: m_name
ENDPOINT: 
add_manufacturer?manufacturer=m_name
Return Values:
(Message string) ‘Manufacturer added successfully.’
Status: SUCCESS
Action: None
(Message string) ‘Missing manufacturer name.’
Status: ERROR
Action: None
Cause: m_name was not set
(Message string) ‘Manufacturer already exists in database.’
Status: ERROR
Action: list_manufacturers
Cause: a manufacturer with m_name is already present in the database
(Message string) ‘QUERY_FAILED: $message.’
Status: ERROR
Action: None
Cause: SQL query failed
add_equipment:
Parameters: 
(Int) did: device_id
(Int) mid: manufacturer_id
(String) sn: serial_number
ENDPOINT: 
add_equipment?did=device_id&mid=manufacturer_id&sn=serial_number
Return Values:
(Message string) ‘Equipment added successfully.’
Status: SUCCESS
Action: None
(Message string) ‘Missing device id.’
Status: ERROR
Action: None
Cause: device_id was not set
(Message string) ‘Missing manufacturer id.’
Status: ERROR
Action: None
Cause: manufacturer_id was not set
(Message string) ‘Missing serial number.’
Status: ERROR
Action: None
Cause: serial_number was not set
(Message string) ‘Invalid device id.’
Status: ERROR
Action: query_device
Cause: device_id was set but not an integer
(Message string) ‘Invalid manufacturer id.’
Status: ERROR
Action: None
Cause: manufacturer_id was set but not an integer
(Message string) ‘Equipment already exists in database.’
Status: ERROR
Action: query_serial 
Cause: equipment with serial_number is already present in the database
(Message string) ‘QUERY_FAILED: $message.’
Status: ERROR
Action: None
Cause: SQL query failed
List:
list_devices:
Parameters: None
ENDPOINT: 
list_devices
Return Values:
(JSON) Array [device_id, device_name, status]
Status: SUCCESS
Action: None
(Message string) ‘No devices found.’
Status: SUCCESS
Action: None
Cause: Query was successful but returned no results
(Message string) ‘QUERY_FAILED: $message.’
Status: ERROR
Action: None
Cause: SQL query failed
list_manufacturers:
Parameters: None
ENDPOINT: 
list_manufacturers
Return Values:
(JSON) Array [manufacturer_id, manufacturer_name, status]
Status: SUCCESS
Action: None
(Message string) ‘No manufacturers found.’
Status: SUCCESS
Action: None
Cause: Query was successful but returned no results
(Message string) ‘QUERY_FAILED: $message.’
Status: ERROR
Action: None
Cause: SQL query failed





Modify:
modify_device:
Parameters: 
(Int) did: device_id 
(String) device: d_name
(String) status: status
ENDPOINT: 
modify_device?did=device_id&device=d_name&status=status
Return Values:
(Message string) ‘Device modified successfully.’
Status: SUCCESS
Action: None
(Message string) ‘Missing device id.’
Status: ERROR
Action: None
Cause: device_id was not set
(Message string) ‘Missing device name.’
Status: ERROR
Action: None
Cause: d_name was not set
(Message string) ‘Missing status.’
Status: ERROR
Action: None
Cause: status was not set
(Message string) Invalid device id.’
Status: ERROR
Action: query_device
Cause: device_id was set but not an integer
(Message string) ‘Device already exists in database.’
Status: ERROR
Action: list_devices
Cause: a device with d_name is already present in the database
(Message string) ‘QUERY_FAILED: $message.’
Status: ERROR
Action: None
Cause: SQL query failed
modify_manufacturer:
Parameters: 
(Int) mid: manufacturer_id
(String) manufacturer: m_name
(String) status: status
ENDPOINT: 
modify_device?mid=manufacturer_id&manufacturer=m_name&status=status
Return Values:
(Message string) ‘Manufacturer modified successfully.’
Status: SUCCESS
Action: None
(Message string) ‘Missing manufacturer id.’
Status: ERROR
Action: None
Cause: manufacturer_id was not set
(Message string) ‘Missing manufacturer name.’
Status: ERROR
Action: None
Cause: m_name was not set
(Message string) ‘Missing status.’
Status: ERROR
Action: None
Cause: status was not set
(Message string) Invalid manufacturer id.’
Status: ERROR
Action: query_manufacturers
Cause: manufacturer_id was set but not an integer
(Message string) ‘Manufacturer already exists in database.’
Status: ERROR
Action: list_manufacturers
Cause: a manufacturer with m_name is already present in the database
(Message string) ‘QUERY_FAILED: $message.’
Status: ERROR
Action: None
Cause: SQL query failed
modify_equipment:
Parameters: 
(Int) eid: equipment_id
(Int) did: device_id
(Int) mid: manufacturer_id
(String) sn: serial_number
(String) status: status
ENDPOINT: 
modify_device?eid=equipment_id&did=device_id&mid=manufacturer_id&sn=serial_number&status=status
Return Values:
(Message string) Equipment modified successfully.’
Status: SUCCESS
Action: None
(Message string) ‘Missing equipment id.’
Status: ERROR
Action: None
Cause: equipment_id was not set
(Message string) ‘Missing device id.’
Status: ERROR
Action: None
Cause: device_id was not set
(Message string) ‘Missing manufacturer id.’
Status: ERROR
Action: None
Cause: manufacturer_id was not set
(Message string) ‘Missing serial number.’
Status: ERROR
Action: None
Cause: serial_number was not set
(Message string) ‘Missing status.’
Status: ERROR
Action: None
Cause: status was not set
(Message string) Invalid equipment id.’
Status: ERROR
Action: query_id
Cause: equipment_id was set but not an integer
(Message string) Invalid device id.’
Status: ERROR
Action: query_device
Cause: device_id was set but not an integer
(Message string) Invalid manufacturer id.’
Status: ERROR
Action: query_manufacturer
Cause: manufacturer_id was set but not an integer
(Message string) Equipment already exists in database.’
Status: ERROR
Action: query_serial 
Cause: equipment with serial_number is already present in the database
(Message string) ‘QUERY_FAILED: $message.’
Status: ERROR
Action: None
Cause: SQL query failed


Query:
query_device:
Parameters: 
(Int) did: device_id
ENDPOINT: 
query_device?did=device_id
Return Values:
(JSON) Single {device_id, device_name, status}
Status: SUCCESS
Action: None
(Message string) ‘Device not found.’
Status: SUCCESS
Action: None
Cause: Query was successful but returned no results
(Message string) ‘Missing device id.’
Status: ERROR
Action: None
Cause: device_id was not set
(Message string) ‘Invalid device id.’
Status: ERROR
Action: None
Cause: device_id was set but not an integer
(Message string) ‘QUERY_FAILED: $message.’
Status: ERROR
Action: None
Cause: SQL query failed
query_manufacturer:
Parameters: 
(Int) mid: manufacturer_id
ENDPOINT: 
query_manufacturer?mid=manufacturer_id
Return Values:
(JSON) Single {manufacturer_id, manufacturer_name, status}
Status: SUCCESS
Action: None
(Message string) ‘Manufacturer not found.’
Status: SUCCESS
Action: None
Cause: Query was successful but returned no results
(Message string) ‘Missing manufacturer id.’
Status: ERROR
Action: None
Cause: manufacturer_id was not set
(Message string) ‘Invalid manufacturer id.’
Status: ERROR
Action: None
Cause: manufacturer_id was set but not an integer
(Message string) ‘QUERY_FAILED: $message.’
Status: ERROR
Action: None
Cause: SQL query failed
query_id:
Parameters: 
(Int) eid: equipment_id
ENDPOINT: 
query_id?eid=equipment_id
Return Values:
(JSON) Single {equipment_id, device_id, manufacturer_id, serial_number, status}
Status: SUCCESS
Action: None
(Message string) ‘Equipment not found.’
Status: SUCCESS
Action: None
Cause: Query was successful but returned no results
(Message string) ‘Missing equipment id.’
Status: ERROR
Action: None
Cause: equipment_id was not set
(Message string) ‘Invalid equipment id.’
Status: ERROR
Action: None
Cause: equipment_id was set but not an integer
(Message string) ‘QUERY_FAILED: $message.’
Status: ERROR
Action: None
Cause: SQL query failed
query_serial:
Parameters: 
(Int) sn: serial_number
ENDPOINT: 
query_id?sn=serial_number
Return Values:
(JSON) Single {equipment_id, device_id, manufacturer_id, serial_number, status}
Status: SUCCESS
Action: None
(Message string) ‘Equipment not found.’
Status: SUCCESS
Action: None
Cause: Query was successful but returned no results
(Message string) ‘Missing serial number.’
Status: ERROR
Action: None
Cause: serial_number was not set
(Message string) ‘QUERY_FAILED: $message.’
Status: ERROR
Action: None
Cause: SQL query failed

Search:
search_devices:
Parameters: 
(Optional int) did: device_id
(Optional int) mid: manufacturer_id
(Optional string) sn: serial_number
(Optional string) include_inactive: include_inactive
ENDPOINT: 
add_equipment?did=device_id&mid=manufacturer_id&sn=serial_number&include_inactive=include_inactive
Return Values:
(JSON) Array [equipment_id, device_id, manufacturer_id, serial_number, status]
Status: SUCCESS
Action: None
(Message string) ‘No equipment found.’
Status: SUCCESS
Action: None
Cause: Query was successful but returned no results
(Message string) ‘Invalid device id.’
Status: ERROR
Action: query_device
Cause: device_id was set but not an integer
(Message string) ‘Invalid manufacturer id.’
Status: ERROR
Action: None
Cause: manufacturer_id was set but not an integer
(Message string) ‘QUERY_FAILED: $message.’
Status: ERROR
Action: None
Cause: SQL query failed

