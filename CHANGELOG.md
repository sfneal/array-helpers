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
