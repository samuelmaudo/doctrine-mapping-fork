Doctrine Mapping
================

[![PHP][php-badge]][php-url]
[![Doctrine][doctrine-badge]][doctrine-url]
[![Code Coverage][codecov-badge]][codecov-url]
[![License][license-badge]][license-url]

[php-badge]: https://img.shields.io/badge/php-8.0%20to%208.3-777bb3.svg
[php-url]: https://github.com/hereldar/doctrine-mapping/actions/workflows/unit-tests.yml
[doctrine-badge]: https://img.shields.io/badge/doctrine-2.18%20to%203.2-fc6a31.svg
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
    Id::of(property: 'id', type: 'integer')
        ->withSequenceGenerator(sequenceName: 'cms_users_seq'),
    Field::of(property: 'name', type: 'string')
        ->withColumn(length: 50, nullable: true, unique: true),
    Field::of(property: 'email', type: 'string')
        ->withColumn(name: 'user_email', definition: 'CHAR(32) NOT NULL'),
)->withAssociations(
    OneToOne::of(property: 'address', inversedBy: 'user', cascade: [Cascade::Remove])
        ->withJoinColumn(name: 'address_id', referencedColumnName: 'id', onDelete: 'CASCADE', onUpdate: 'CASCADE'),
    OneToMany::of(property: 'phonenumbers', targetEntity: Phonenumber::class, mappedBy: 'user', cascade: [Cascade::Persist]),
    ManyToMany::of(property: 'groups', targetEntity: Group::class, cascade: [Cascade::All])
        ->withJoinTable(name: 'cms_user_groups')
        ->withJoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: true, unique: false)
        ->withInverseJoinColumn(name: 'group_id', referencedColumnName: 'id', columnDefinition: 'INT NULL'),
)->withIndexes(
    Index::of(fields: 'name', name: 'name_idx'),
    Index::of(columns: 'user_email'),
)->withUniqueConstraints(
    UniqueConstraint::of(columns: ['name', 'user_email'], name: 'search_idx'),
);
```

Supported Attributes
--------------------

- [ ] [AssociationOverride](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_associationoverride)
- [ ] [AttributeOverride](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_attributeoverride)
- [x] [Column](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_column)
- [ ] [Cache](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_cache)
- [ ] [ChangeTrackingPolicy](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_changetrackingpolicy)
- [x] [CustomIdGenerator](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_customidgenerator)
- [ ] [DiscriminatorColumn](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_discriminatorcolumn)
- [ ] [DiscriminatorMap](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_discriminatormap)
- [x] [Embeddable](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_embeddable)
- [x] [Embedded](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_embedded)
- [x] [Entity](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_entity)
- [x] [GeneratedValue](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_generatedvalue)
- [ ] [HasLifecycleCallbacks](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_haslifecyclecallbacks)
- [x] [Index](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_index)
- [x] [Id](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_id)
- [ ] [InheritanceType](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_inheritancetype)
- [x] [JoinColumn](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_joincolumn)
- [x] [JoinTable](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_jointable)
- [x] [ManyToOne](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_manytoone)
- [x] [ManyToMany](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_manytomany)
- [x] [MappedSuperclass](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_mappedsuperclass)
- [x] [OneToOne](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_onetoone)
- [x] [OneToMany](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_onetomany)
- [x] [OrderBy](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_orderby)
- [ ] [PostLoad](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_postload)
- [ ] [PostPersist](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_postpersist)
- [ ] [PostRemove](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_postremove)
- [ ] [PostUpdate](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_postupdate)
- [ ] [PrePersist](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_prepersist)
- [ ] [PreRemove](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_preremove)
- [ ] [PreUpdate](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_preupdate)
- [x] [SequenceGenerator](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_sequencegenerator)
- [x] [Table](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_table)
- [x] [UniqueConstraint](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_uniqueconstraint)
- [ ] [Version](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/attributes-reference.html#attrref_version)

**Currently under development.**
