# korba-ussd
A library to make building USSDs faster and easier. The purpose is to provide you with methods that are used always in building USSD. It contains two class **View** and **Util**, which are all under the namespace **Korba**.

### View
This class is the *parent* class for generating the view to be seen on the phones USSDs. Every new *view* must be created as a class and should inherit from View. It default constructor must be overwritten.

### Util
This is a class that can not be inherited from. It can't be initializes either. It contains static methods that ease with complex manipulation, transformation and evaluation of the USSD code.

## install
To install, just run the following command in the terminal in the project dir.

```$xslt
composer require cybersai/korba-ussd
```

## Fields in View
| Field | Data Type | Description |
|-------|-----------|-------------|
| content | `string` or `string[]` | This is the Default view to output to the screen if there are no list involved. When it is an array, the page variable help to determine which item in the array is displayed at a time.|
| next | string or string[] | This is the variable to help determine the next View. When it is an array, the page variable help to determine which item in the array is next View to visit. |
| page| `int` | This is used to specify which *content*, *next* or *end* should be selected from those field if they happen to be array. In the case *content*, *next* and *end* are not array but there is a list on the view, *page* is used to specify what page of the list should be displayed. |
| number_per_page | `int` | This is used to specify how *iteratable_list* should be segment into pages |
| iteratable_list | `string[]` or `object[]` | This is a list that should be render in the view |
| iterator | `string[]` | When *null*, then the *iterable_list* is an array of string. But when it has a value, the second item in the array is used as the associative array index of the *iterable_list* |
| end | `string` or `string[]` | Has the same behaviour as *content* and *next*. It appended to the View |

## Methods in View
* `View($content , $next, $page = 1, $number_per_page = null, $iterable_list = null, $iterator = null, $end = null)`
* `getContent()`
* `getNext()`
* `getPage()`
* `getNumberPerPage()`
* `getIterableList()`
* `getIterator()`
* `getEnd()`
* `parseToString()`
* `makeList()`
* `arrayToList($page, $number_per_page, $array, $nested_indices = null)`
