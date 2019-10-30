# Mage2 Module OrviSoft AttributeGroups

    `orvisoft/module-attributegroups`

 - [Main Functionalities](#main-functionalities)
 - [Installation](#installation)
 - [Configuration](#configuration)
 - [Specifications](#specifications)
 - [Attributes](#attributes)


## Main Functionalities
This module helps to group product attributes on product page.

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/OrviSoft`
 - Enable the module by running `php bin/magento module:enable OrviSoft_AttributeGroups`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require orvisoft/module-attributegroups`
 - enable the module by running `php bin/magento module:enable OrviSoft_AttributeGroups`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

 - Status (attribute_groups/configuration/status)


## Specifications

 - Helper
	- OrviSoft\AttributeGroups\Helper\Attributes

 - Model
	- GroupAttribute


## Attributes

 - Product - Specification Group (specification_group)
