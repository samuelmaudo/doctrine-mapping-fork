<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

/**
 * @psalm-immutable
 */
final class Field
{
    private function __construct(
        private string $property,
        private ?string $column,
        private ?string $columnDefinition,
        private ?string $type,
        private ?string $enumType,
        private bool $primaryKey,
        private bool $unique,
        private ?bool $nullable,
        private bool $insertable,
        private bool $updatable,
        private int|string|null $generated,
        private ?int $length,
        private ?int $precision,
        private ?int $scale,
        private mixed $default,
        private ?bool $unsigned,
        private ?bool $fixed,
        private ?string $charset,
        private ?string $collation,
        private ?string $comment,
    ) {}

    /**
     * @param non-empty-string $property The name of the field in the Entity.
     * @param ?non-empty-string $column The column name (defaults to the field name).
     * @param ?non-empty-string $columnDefinition The SQL fragment that is used when generating the DDL for the column (non-portable).
     * @param ?non-empty-string $type
     * @param ?enum-string $enumType
     * @param bool $primaryKey Marks the field as the primary key of the entity (multiple fields can have the `$primaryKey` attribute, forming a composite key).
     * @param bool $unique Whether a unique constraint should be generated for the column.
     * @param ?bool $nullable Whether the column is nullable (defaults to FALSE).
     * @param bool $insertable Whether the column is insertable (defaults to TRUE).
     * @param bool $updatable Whether the column is updatable (defaults to TRUE).
     * @param int<0, 2>|'NEVER'|'INSERT'|'ALWAYS'|null $generated Whether a generated value should be retrieved from the database after INSERT or UPDATE.
     * @param ?positive-int $length The database length of the column.
     * @param ?non-negative-int $precision The maximum number of digits that can be stored (applies only for `decimal` columns).
     * @param ?non-negative-int $scale The number of digits to the right of the decimal point (applies only for `decimal` columns and must not be greater than the precision).
     * @param mixed $default The default value to set for the column if no value is supplied.
     * @param ?bool $unsigned Whether the column can store only non-negative integers (applies only for `integer` columns and might not be supported by all vendors).
     * @param ?bool $fixed Whether the column length is fixed or varying (applies only for `string` and `binary` columns, and might not be supported by all vendors).
     * @param ?non-empty-string $charset The charset of the column (only supported by MySQL, PostgreSQL, SQLite and SQL Server).
     * @param ?non-empty-string $collation The collation of the column (only supported by MySQL, PostgreSQL, SQLite and SQL Server).
     * @param ?non-empty-string $comment The comment of the column in the schema (might not be supported by all vendors).
     */
    public static function of(
        string $property,
        ?string $column = null,
        ?string $columnDefinition = null,
        ?string $type = null,
        ?string $enumType = null,
        bool $primaryKey = false,
        bool $unique = false,
        ?bool $nullable = null,
        bool $insertable = true,
        bool $updatable = true,
        int|string|null $generated = null,
        ?int $length = null,
        ?int $precision = null,
        ?int $scale = null,
        mixed $default = null,
        ?bool $unsigned = null,
        ?bool $fixed = null,
        ?string $charset = null,
        ?string $collation = null,
        ?string $comment = null,
    ): self {
        return new self(
            $property,
            $column,
            $columnDefinition,
            $type,
            $enumType,
            $primaryKey,
            $unique,
            $nullable,
            $insertable,
            $updatable,
            $generated,
            $length,
            $precision,
            $scale,
            $default,
            $unsigned,
            $fixed,
            $charset,
            $collation,
            $comment,
        );
    }

    public function property(): string
    {
        return $this->property;
    }

    public function column(): ?string
    {
        return $this->column;
    }

    public function columnDefinition(): ?string
    {
        return $this->columnDefinition;
    }

    public function type(): ?string
    {
        return $this->type;
    }

    public function enumType(): ?string
    {
        return $this->enumType;
    }

    public function primaryKey(): bool
    {
        return $this->primaryKey;
    }

    public function unique(): bool
    {
        return $this->unique;
    }

    public function nullable(): ?bool
    {
        return $this->nullable;
    }

    public function insertable(): bool
    {
        return $this->insertable;
    }

    public function updatable(): bool
    {
        return $this->updatable;
    }

    public function generated(): int|string|null
    {
        return $this->generated;
    }

    public function length(): ?int
    {
        return $this->length;
    }

    public function precision(): ?int
    {
        return $this->precision;
    }

    public function scale(): ?int
    {
        return $this->scale;
    }

    public function default(): mixed
    {
        return $this->default;
    }

    public function unsigned(): ?bool
    {
        return $this->unsigned;
    }

    public function fixed(): ?bool
    {
        return $this->fixed;
    }

    public function charset(): ?string
    {
        return $this->charset;
    }

    public function collation(): ?string
    {
        return $this->collation;
    }

    public function comment(): ?string
    {
        return $this->comment;
    }
}
