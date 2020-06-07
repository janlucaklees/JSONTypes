# JSONTypes

A JSON validation library for php that almost feels like using React PropTypes.

## Motivation

A few weeks ago, I was in need for something to validate some JSON files and all I could find were some libraries that 
implemented JSON Schema based validation. Unfortunately, they were not too well documented and not up to the newest
draft. More importantly though, I realized how clumsy it is to work with JSON Schema. Having worked with React much, I
really do love my PropTypes. They are very readable in two ways: Most importantly, they preserve the structure of the
data to be validated. And secondly, they have all the information about one attribute (property in php) in one place.

So as I am in need of a JSON validation again, I decided to implement my own here.

## Status

So far this project is in the making and not yet releasable. Mostly we are missing features to really make this usable.
But, testing and automatic building and publishing are also something I'd like ot add.

### Missing features

- Basically all validation types that PropTypes offers.
- Extensive testing to prevent errors
- Automatic building and publishing
- Future: Generation of JSON Schema used for sharing validation between services

## Running the test

For the tests there is a composer script. Just run them with `composer run tests`.
