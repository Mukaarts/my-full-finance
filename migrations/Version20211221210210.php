<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211221210210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE crypto_wallet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titÃle VARCHAR(255) NOT NULL)');
        $this->addSql('DROP INDEX IDX_2D0D0909DCD6110');
        $this->addSql('CREATE TEMPORARY TABLE __temp__dividend AS SELECT id, stock_id FROM dividend');
        $this->addSql('DROP TABLE dividend');
        $this->addSql('CREATE TABLE dividend (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, stock_id INTEGER NOT NULL, CONSTRAINT FK_2D0D0909DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO dividend (id, stock_id) SELECT id, stock_id FROM __temp__dividend');
        $this->addSql('DROP TABLE __temp__dividend');
        $this->addSql('CREATE INDEX IDX_2D0D0909DCD6110 ON dividend (stock_id)');
        $this->addSql('DROP INDEX IDX_723705D18510D4DE');
        $this->addSql('DROP INDEX IDX_723705D1712520F3');
        $this->addSql('DROP INDEX IDX_723705D1DCD6110');
        $this->addSql('CREATE TEMPORARY TABLE __temp__transaction AS SELECT id, stock_id, wallet_id, depot_id, order_type, amount, price, fee, date_at FROM "transaction"');
        $this->addSql('DROP TABLE "transaction"');
        $this->addSql('CREATE TABLE "transaction" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, stock_id INTEGER NOT NULL, wallet_id INTEGER DEFAULT NULL, depot_id INTEGER DEFAULT NULL, order_type INTEGER NOT NULL, amount NUMERIC(10, 2) NOT NULL, price NUMERIC(10, 2) NOT NULL, fee NUMERIC(10, 2) NOT NULL, date_at DATE NOT NULL, CONSTRAINT FK_723705D1DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_723705D1712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_723705D18510D4DE FOREIGN KEY (depot_id) REFERENCES depot (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "transaction" (id, stock_id, wallet_id, depot_id, order_type, amount, price, fee, date_at) SELECT id, stock_id, wallet_id, depot_id, order_type, amount, price, fee, date_at FROM __temp__transaction');
        $this->addSql('DROP TABLE __temp__transaction');
        $this->addSql('CREATE INDEX IDX_723705D18510D4DE ON "transaction" (depot_id)');
        $this->addSql('CREATE INDEX IDX_723705D1712520F3 ON "transaction" (wallet_id)');
        $this->addSql('CREATE INDEX IDX_723705D1DCD6110 ON "transaction" (stock_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE crypto_wallet');
        $this->addSql('DROP INDEX IDX_2D0D0909DCD6110');
        $this->addSql('CREATE TEMPORARY TABLE __temp__dividend AS SELECT id, stock_id FROM dividend');
        $this->addSql('DROP TABLE dividend');
        $this->addSql('CREATE TABLE dividend (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, stock_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO dividend (id, stock_id) SELECT id, stock_id FROM __temp__dividend');
        $this->addSql('DROP TABLE __temp__dividend');
        $this->addSql('CREATE INDEX IDX_2D0D0909DCD6110 ON dividend (stock_id)');
        $this->addSql('DROP INDEX IDX_723705D1DCD6110');
        $this->addSql('DROP INDEX IDX_723705D1712520F3');
        $this->addSql('DROP INDEX IDX_723705D18510D4DE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__transaction AS SELECT id, stock_id, wallet_id, depot_id, order_type, amount, price, fee, date_at FROM "transaction"');
        $this->addSql('DROP TABLE "transaction"');
        $this->addSql('CREATE TABLE "transaction" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, stock_id INTEGER NOT NULL, wallet_id INTEGER DEFAULT NULL, depot_id INTEGER DEFAULT NULL, order_type INTEGER NOT NULL, amount NUMERIC(10, 2) NOT NULL, price NUMERIC(10, 2) NOT NULL, fee NUMERIC(10, 2) NOT NULL, date_at DATE NOT NULL)');
        $this->addSql('INSERT INTO "transaction" (id, stock_id, wallet_id, depot_id, order_type, amount, price, fee, date_at) SELECT id, stock_id, wallet_id, depot_id, order_type, amount, price, fee, date_at FROM __temp__transaction');
        $this->addSql('DROP TABLE __temp__transaction');
        $this->addSql('CREATE INDEX IDX_723705D1DCD6110 ON "transaction" (stock_id)');
        $this->addSql('CREATE INDEX IDX_723705D1712520F3 ON "transaction" (wallet_id)');
        $this->addSql('CREATE INDEX IDX_723705D18510D4DE ON "transaction" (depot_id)');
    }
}
