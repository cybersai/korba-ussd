# korba-ussd
A library to make building USSDs faster and easier. It contains two class **View** and **Util** all under the namespace **Korba**.

### View
This class is the *parent* class for generating the view to be seen on the phones USSDs. Every new *view* must be created as a class and should inherit from View.

### Util
This is a class that can not be inherited from. It can't be initializes either. It contains static methods that ease with complex manupulation, transformation and evaluation of the USSD code.

## install
To install, just run the following command in the terminal in the project dir.
```$xslt
composer require cybersai/korba-ussd
```
## Fields in View
| Field | Data Type | Description |
|-------|-----------|-------------|
| content | string or string[] | This is the Default view to output to the screen if there are not list involved. When it is an array, the page variable help to determine which item in the array is displayed at a time.

* content
* next
* page
* number_per_page
* iteratable_list
* iterator
* end

## Methods in View
* getContent()
* get
