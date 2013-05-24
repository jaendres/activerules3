<?
/**php
 * Form-L form definition language
 */
var definition = {
     "name": "login",
     "method": "POST",
     "terms": [
        {
           "username": [
           {
              "field_name": "username",
              "field_type": "text",
              "label": "Username",
              "validation": [
                  {
                    "required": TRUE,
                    "min_length": 3,
                    "max_length": 64,
                    "alphanumeric": TRUE,
                  }
              ],
              "pre_filter": [
                  {
                    "trim": TRUE,
                    "strtolower": TRUE,
                  }
              ]
           }
           ]
        },
        {
           "password": [
           {
              "field_name": "password",
              "field_type": "password",
              "label": "Password",
              "validation": [
                  {
                    "required": TRUE,
                    "min_length": 6,
                    "max_length": 64,
                  }
              ],
              "pre_filter": [
                  {
                    "trim": TRUE,
                  }
              ],
              "post_filter": [
                  {
                    "ar::secure_hash": TRUE,
                  }
              ]


           }
           ]
        }
     ],
     "buttons": [
             "submit": [
                "button_name": "submit",
                "button_type": "button",
                "label": "Login",
                "action": "form/login",
             ]
     ]

}

