Doctrine Mapping
================

[![PHP][php-badge]][php-url]
[![Doctrine][doctrine-badge]][doctrine-url]
[![Code Coverage][codecov-badge]][codecov-url]
[![License][license-badge]][license-url]

[php-badge]: https://img.shields.io/badge/php-8.0%20to%208.3-777bb3.svg
[php-url]: https://github.com/hereldar/doctrine-mapping/actions/workflows/unit-tests.yml
[doctrine-badge]: https://img.shields.io/badge/doctrine-2.16%20to%203.0-fc6a31.svg
[doctrine-url]: https://github.com/hereldar/doctrine-mapping/actions/workflows/unit-tests.yml
[codecov-badge]: https://img.shields.io/codecov/c/github/hereldar/doctrine-mapping
[codecov-url]: https://app.codecov.io/gh/hereldar/doctrine-mapping
[coveralls-badge]: https://img.shields.io/coverallsCoverage/github/hereldar/doctrine-mapping
[coveralls-url]: https://coveralls.io/github/hereldar/doctrine-mapping
[license-badge]: https://img.shields.io/badge/license-MIT-brightgreen.svg
[license-url]: LICENSE

An alternative Doctrine object mapper that allows to configure 
entities in separate PHP files.

```php
<?php

use ...

return Entity::of(
    class: User::class,
)->withTable(
    name: 'cms_users',
    schema: 'main',
)->withFields(
    Id::of(property: 'id', type: 'integer')->withSequenceGenerator(sequenceName: 'sequence'),
    Field::of(property: 'name', type: 'string')->withColumn(length: 50, nullable: true, unique: true),
    Field::of(property: 'email', type: 'string')->withColumn(name: 'user_email', definition: 'CHAR(32) NOT NULL'),
)->withIndexes(
    Index::of(fields: 'name', name: 'name_idx'),
    Index::of(columns: 'user_email'),
)->withUniqueConstraints(
    UniqueConstraint::of(columns: ['name', 'user_email'], name: 'search_idx'),
);
```

**Currently under development.**
