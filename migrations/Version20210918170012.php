<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210918170012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_4B36566077E1607F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__stock AS SELECT id, transactions_id, name, ticker, color FROM stock');
        $this->addSql('DROP TABLE stock');
        $this->addSql('CREATE TABLE stock (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, transactions_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, ticker VARCHAR(10) NOT NULL COLLATE BINARY, color VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_4B36566077E1607F FOREIGN KEY (transactions_id) REFERENCES "transaction" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO stock (id, transactions_id, name, ticker, color) SELECT id, transactions_id, name, ticker, color FROM __temp__stock');
        $this->addSql('DROP TABLE __temp__stock');
        $this->addSql('CREATE INDEX IDX_4B36566077E1607F ON stock (transactions_id)');
        $this->addSql('ALTER TABLE "transaction" ADD COLUMN date DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_4B36566077E1607F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__stock AS SELECT id, transactions_id, name, ticker, color FROM stock');
        $this->addSql('DROP TABLE stock');
        $this->addSql('CREATE TABLE stock (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, transactions_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, ticker VARCHAR(10) NOT NULL, color VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO stock (id, transactions_id, name, ticker, color) SELECT id, transactions_id, name, ticker, color FROM __temp__stock');
        $this->addSql('DROP TABLE __temp__stock');
        $this->addSql('CREATE INDEX IDX_4B36566077E1607F ON stock (transactions_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__transaction AS SELECT id, order_type, amount, price, fee FROM "transaction"');
        $this->addSql('DROP TABLE "transaction"');
        $this->addSql('CREATE TABLE "transaction" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, order_type INTEGER NOT NULL, amount NUMERIC(10, 2) NOT NULL, price NUMERIC(10, 2) NOT NULL, fee NUMERIC(10, 2) NOT NULL)');
        $this->addSql('INSERT INTO "transaction" (id, order_type, amount, price, fee) SELECT id, order_type, amount, price, fee FROM __temp__transaction');
        $this->addSql('DROP TABLE __temp__transaction');
    }
}
