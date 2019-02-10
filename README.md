# Routine API

This is a REST API for workout routines

---

Routine (Please see source code for other objects):

    Create: POST
        request: https://routine.buzztrench.com/api/interface/routine/create.php
        ```
        {
            "name": "Test Workout4",
            "description": "This is a sample4",
            "days": 2,
            "purpose_id": 20,
            "day": {
                "0": {
                    "sets": 3,
                    "name": "Chest Day",
                    "set": {
                        "0":{
                            "name": "Bench",
                            "reps": 4,
                            "tempo": "2-0-1"
                        },
                        "1":{
                            "name": "Bench",
                            "reps": 4,
                            "tempo": "2-0-1"
                        },
                        "2":{
                            "name": "Bench",
                            "reps": 4,
                            "tempo": "2-0-1"
                        }
                    }
                },
                "1": {
                    "sets": 3,
                    "name": "Leg Day",
                    "set": {
                        "0":{
                            "name": "Squat",
                            "reps": 4,
                            "tempo": "2-0-1"
                        },
                        "1":{
                            "name": "Squat",
                            "reps": 4,
                            "tempo": "2-0-1"
                        },
                        "2":{
                            "name": "Leg Press",
                            "reps": 10,
                            "tempo": "2-0-1"
                        }
                    }
                }
            }
        }
        ```
        response:
        ```
        {
            "message": "routine was created.",
            "Day0": {
                "message": "Day was created."
            },
            "Set0 of Day0": {
                "message": "Set was created."
            },
            "Set1 of Day0": {
                "message": "Set was created."
            },
            "Set2 of Day0": {
                "message": "Set was created."
            },
            "Day1": {
                "message": "Day was created."
            },
            "Set0 of Day1": {
                "message": "Set was created."
            },
            "Set1 of Day1": {
                "message": "Set was created."
            },
            "Set2 of Day1": {
                "message": "Set was created."
            }
        }
        ```
    
    Delete: POST
    request: https://routine.buzztrench.com/api/interface/routine/delete.php
    ```
    {
        "id": 1
    }
    ```
    response:
    ```
    {
        "message": "routine was deleted"
    }
    ```
    Read: Get
        request: https://routine.buzztrench.com/api/interface/routine/read.php
        response:
        ```
        {
            "records": [
                {
                    "id": "25",
                    "name": "delete",
                    "purpose_id": "20",
                    "description": ""
                },
                {
                            "id":"19",
                            "name":"Test Workout",
                            "description":"This is a sample"
                },
                {
                    "id": "20",
                    "name": "Test Workout2",
                    "purpose_id": "19",
                    "description": "This is a sample2"
                },
                {
                    "id": "21",
                    "name": "Test Workout2",
                    "purpose_id": "19",
                    "description": "This is a sample2"
                },
                {
                    "id": "22",
                    "name": "Test Workout2",
                    "purpose_id": "19",
                    "description": "This is a sample2"
                },
                {
                    "id": "23",
                    "name": "Test Workout2",
                    "purpose_id": "19",
                    "description": "This is a sample2"
                },
                {
                    "id": "24",
                    "name": "Test Workout3",
                    "purpose_id": "20",
                    "description": "This is a sample2"
                },
                {
                    "id": "26",
                    "name": "Test Workout3",
                    "purpose_id": "20",
                    "description": "This is a sample3"
                },
                {
                    "id": "27",
                    "name": "Test Workout4",
                    "purpose_id": "20",
                    "description": "This is a sample4"
                },
                {
                    "id": "28",
                    "name": "Test Workout4",
                    "purpose_id": "20",
                    "description": "This is a sample4"
                }
            ]
        }
        ```
    
    Read One: Get
        request: https://routine.buzztrench.com/api/interface/routine/read_one.php?id=17
        response:
        ```
        {
            "id":"20",
            "name":"Test Workout2",
            "description":"This is a sample2",
            "days":[
                {
                    "id":"21",
                    "name":"Chest Day",
                    "routine_id":"20"
                }
            ]
        }
        ```
    Search: GET
        request: https://routine.buzztrench.com/api/interface/routine/search.php?s=4
        response:
        ```
        {
            "records":[
                {
                    "id":"27",
                    "name":"Test Workout4",
                    "description":"This is a sample4"
                },
                {
                    "id":"28",
                    "name":"Test Workout4",
                    "description":"This is a sample4"
                }
            ]
        }
        ```
    Update: POST
        request: https://routine.buzztrench.com/api/interface/routine/update.php
        ```
        {
            "id": 25,
            "name": "delete",
            "purpose_id": 20,
            "days": 3,
            "description": ""
        }
        ```
        response:
        ```
        {
            "message": "routine was updated."
        }
        ``` 

---

You can interact with the website here:

https://routine.buzztrench.com
