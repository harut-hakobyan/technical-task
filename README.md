# Getting Started
## 1. Clone the Project:

git clone https://github.com/harut-hakobyan/technical-task.git
```bash
cd technical-task
```


## 2. Switch on Docker:

Ensure Docker i installed on your machine. If not, download and install Docker from [Docker's official website](https://docs.docker.com/desktop/).

## 3. Navigate to the Docker Folder:
```bash
cd docker
````
## 4. Run Docker:

Execute the following command to start the Docker containers and set up the Laravel environment:
```bash
sh run.sh
```

## 5. Generate Key:

Execute the following commands to generate Application <br/> Key
In the docker folder execute command
```bash
docker exec -it task_server bash
```
After that generate a key
```bash
php artisan key:generate
```

# 6. Access the App:

Open your web browser and visit to access your application.

Technical Task [http://localhost.8082](http://localhost.8082/) <br/>

# 7. Endpoints list:

### For User

#### Register <br/>
API - localhost:8082/api/v1/auth/register <br/> 
Method - POST
<br/><br/>
Body - { <br/>
"email":"harut.hakobyan2013@gmail.com", <br/>
"name": "Harut", <br/>
"password" : "Asdasd123!", <br/>
"password_confirmation" : "Asdasd123!" <br/>
}

#### Login <br/>

API - localhost:8082/api/v1/auth/login <br/>
Method - POST
<br/><br/>
Body - { <br/>
"email":"harut.hakobyan2013@gmail.com", <br/>
"password" : "Asdasd123!", <br/>
}

### For Report

#### Get Reports <br/>

API - localhost:8082/api/v1/report <br/>
Method - GET

Header - {Bearer token is required} <br/>

### For Websites

#### Get Websites ( With pagination ) <br/>

API - localhost:8082/api/v1/websites <br/> 
Method - GET

Header - {Bearer token is required} <br/>

#### Get Website Report ( With specific ID ) <br/>

API - localhost:8082/api/v1/websites/{id}/report <br/>
Method - GET

Header - {Bearer token is required} <br/>

#### Create Website <br/>

API - localhost:8082/api/v1/websites <br/>
Method - POST <br/>

Body - { <br/>
"url":"https://www.google.com" <br/>
}

Header - {Bearer token is required} <br/>

#### Update Website <br/>

API - localhost:8082/api/v1/websites/{id} <br/>
Method - PUT

Body - { <br/>
"url":"https://www.google.com" <br/>
}

Header - {Bearer token is required} <br/>

#### Delete Website <br/>

API - localhost:8082/api/v1/websites/{id} <br/>
Method - DELETE

Header - {Bearer token is required} <br/>

#### Show Website <br/>

API - localhost:8082/api/v1/websites/{id} <br/>
Method - GET

Header - {Bearer token is required} <br/>
