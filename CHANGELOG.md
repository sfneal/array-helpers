# Changelog

All notable changes to `array-helpers` will be documented in this file

## 0.1.0 - 2020-09-09
- initial release


## 0.2.0 - 2020-10-05
- add support for php 7.0 & 7.1


## 0.2.1 - 2020-10-06
- add support for php 5.3-5.6


## 0.2.2 - 2020-10-06
- cut support for php 5.3 & 5.4


## 0.2.3 - 2020-10-06
- fix compatibility issues with php5


## 0.3.0 - 2020-12-04
- add support for php8


## 0.3.1 - 2020-12-11
- fix support for php8


## 0.3.2 - 2020-12-15
- add full test suite
- add improved type hinting


## 1.0.0 - 2021-01-21
- make ArrayHelpers class that holds array-helpers functionality
- cut autoloading of arrays.php helper functions
- initial production release


## 1.1.0 - 2021-02-10
- cut depreciated sum_arrays & array_unset helper functions


## 1.1.1 - 2021-03-30
- fix sfneal/actions version syntax
- fix Travis CI config to enable code coverage uploads


## 1.2.0 - 2021-03-31
- bump min sfneal/actions version to 2.0
- refactor `ChunkSizer` to extend `Action` instead of `ActionStatic`


## 1.3.0 - 2021-07-29
- cut illuminate/support from composer dev requirements
- add `random` method to `ArrayHelpers` with helper function for retrieving random array elements


## 1.4.0 - 2021-08-02
- refactor tests into 'Unit' & 'Feature' namespaces
- optimize test suite by adding more detail tests with data providers for multiple param sets
- cut support for php7.0
- fix issue with `ArrayHelpers::arrayValuesUnique()` not properly determining values are not unique
- fix issue with `ArrayHelpers::arrayValuesUnique()` not being able to handle arrays with nested keys
- fix issues with `ArrayHelpers::arrayHasKeys()` method not returning false when array was 1d


## 1.4.1 - 2021-08-03
- optimize `ChunkSizerTest` to use dataProviders


## 1.5.0 - 2021-08-03
- refactor `ArrayHelpers::arrayUnset()` method to `arrayPop()` because an element is being 'popped' from the array
- make `ArrayHelpers::arrayUnset()` method for removing an element & returning a new array


## 1.5.1 - 2021-08-03
- optimize `arrayChunks()` helper & `ArrayHelpers::arrayChunks()` methods parameter type hinting

 
## 1.6.0 - 2021-08-03
- add `ArrayHelpers::diffFlat()` method with the same functionality as the `array_diff_flat()` helper
- make `DiffFlatTest` for testing `ArrayHelpers::diffFlat()` & `array_diff_flat()` helper function
- add `ArrayHelpers::arrayValuesNotEqual()` method & `arrayValuesNotEqual()` helper


## 2.0.0 - 2021-08-03
- refactor `ArrayHelpers` to not use the 'array' prefix in method names
 
 
## 3.0.0 - 2021-08-04
- refactor `ArrayUtility` methods that returned an array to return `self` to support method stacking
- refactor `ArrayHelpers` to serve as a static constructor for the `ArrayUtility` class


## 3.1.0 - 2021-08-04
- optimize `ArrayHelpers::sum()` method & `arraySum()` helper to accept variadic array params


## 3.1.1 - 2021-08-05
- add test methods to `FlattenKeysTest` that tests data sets using $nest_keys param set as true & false
