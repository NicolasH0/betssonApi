Betsson assesment test PHP
Requirements
PHP 7.0 +
Mysql
Install
Clone this repo
Import SQL file into your database
Make sure you changed the database credentials with your setup
API actions
API responses are only in JSON

[Get customer] - Get all informations about a selected customer

Specify an existing customer Id
Link: http://localhost/betsson/api/customers/customer?id=12
Response: {“id”:“12”,“firstName”:“test”,“lastName”:“test”,“email”:“nicdodddds@gmail.com”,“gender”:“test”,“countryCode”:“test”,“bonusPercent”:“test”,“balance”:“200”,“bonusBalance”:“0”,“depositCounter”:“1”}
[Get list of customers ids] - List of customer Ids

Link: http://localhost/betsson/api/customers/customers
Response: {“customers”:[{“id”:“1”},{“id”:“11”},{“id”:“12”},{“id”:“13”},{“id”:“15”},{“id”:“14”},{“id”:“10”},{“id”:“16”},{“id”:“17”},{“id”:“18”},{“id”:“19”},{“id”:“20”},{“id”:“21”},{“id”:“22”},{“id”:“23”},{“id”:“24”}]}
[Update customer] - Edit customer

Body: id:1
firstName:test
lastName:test
gender:F
email:nicolas@gmail.com
countryCode:MT
balance:0
bonusBalance:0
Link: http://localhost/betsson/api/customers/update
Response: { “message”: “Customer Updated” }
[Deposit] - Deposit money to customer balance

Body: id:15
amount:100
Link: http://localhost/betsson/api/customers/deposit
Response: { “message”: “Customer Updated” }
[Withdraw] - Withdraw money from customer balance

Body: id:15
amount:100
Link: http://localhost/betsson/api/customers/withdraw
Response: { “message”: “Customer Updated” }
[Create customer] - Create a new customer

Body: firstName:test
lastName:test
gender:F
email:dddd@gmail.com
countryCode:MT
balance:100
bonusBalance:0
Link: http://localhost/betsson/api/customers/create
Response: {“message”:“New customer created”}
[Reporting] - Find reports from a selected day interval (default 7)

Link : http://localhost/betsson/api/reporting/report?dayInterval=1 or http://localhost/betsson/api/reporting/report
Response: {“01/02/2022”:{“LU”:{“totalDeposit”:200,“No of deposit”:2},“MT”:{“totalDeposit”:600,“No of deposit”:6,“totalWithdraw”:-150,“No of withdraw”:3},“FR”:{“totalDeposit”:100,“No of deposit”:1,“totalWithdraw”:-100,“No of withdraw”:2}}}