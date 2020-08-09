<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200808205457 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE accum_stock (id INT AUTO_INCREMENT NOT NULL, recorder_invoice_id INT DEFAULT NULL, recorder_order_id INT DEFAULT NULL, product_id INT NOT NULL, warehouse_id INT NOT NULL, period DATETIME NOT NULL, recorder INT DEFAULT NULL, record_kind SMALLINT DEFAULT NULL, quantity NUMERIC(10, 3) NOT NULL, reserved_quantity NUMERIC(10, 3) NOT NULL, INDEX IDX_DBFE538883D48C68 (recorder_invoice_id), INDEX IDX_DBFE5388D4E0264C (recorder_order_id), INDEX IDX_DBFE53884584665A (product_id), INDEX IDX_DBFE53885080ECDE (warehouse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accum_stock_total (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, warehouse_id INT NOT NULL, period DATETIME NOT NULL, quantity NUMERIC(10, 3) NOT NULL, reserved_quantity NUMERIC(10, 3) NOT NULL, INDEX IDX_222295294584665A (product_id), INDEX IDX_222295295080ECDE (warehouse_id), UNIQUE INDEX dimensions_idx (period, product_id, warehouse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_post (id VARCHAR(32) NOT NULL, title VARCHAR(64) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doc_invoice (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, total_sum NUMERIC(10, 2) NOT NULL, version INT DEFAULT 1 NOT NULL, marked TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doc_invoice_product (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, product_id INT NOT NULL, quantity NUMERIC(10, 3) NOT NULL, price NUMERIC(10, 2) NOT NULL, sum NUMERIC(10, 2) NOT NULL, line_no INT NOT NULL, INDEX IDX_D9D4A0C47E3C61F9 (owner_id), INDEX IDX_D9D4A0C44584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doc_order (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, version INT DEFAULT 1 NOT NULL, marked TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, author_email VARCHAR(255) NOT NULL, published_at DATETIME NOT NULL, INDEX IDX_5A8A6C8DF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(100) NOT NULL, author_name VARCHAR(255) NOT NULL, post_text LONGTEXT NOT NULL, locale VARCHAR(5) NOT NULL, UNIQUE INDEX UNIQ_5829CF40989D9B62 (slug), INDEX IDX_5829CF402C2AC5D3 (translatable_id), UNIQUE INDEX post_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ref_product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, version INT DEFAULT 1 NOT NULL, marked TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ref_warehouse (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, version INT DEFAULT 1 NOT NULL, marked TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) NOT NULL, object_class VARCHAR(255) NOT NULL, field VARCHAR(32) NOT NULL, foreign_key VARCHAR(64) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX translations_lookup_idx (locale, object_class, foreign_key), UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', username VARCHAR(255) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('ALTER TABLE accum_stock ADD CONSTRAINT FK_DBFE538883D48C68 FOREIGN KEY (recorder_invoice_id) REFERENCES doc_invoice (id)');
        $this->addSql('ALTER TABLE accum_stock ADD CONSTRAINT FK_DBFE5388D4E0264C FOREIGN KEY (recorder_order_id) REFERENCES doc_order (id)');
        $this->addSql('ALTER TABLE accum_stock ADD CONSTRAINT FK_DBFE53884584665A FOREIGN KEY (product_id) REFERENCES ref_product (id)');
        $this->addSql('ALTER TABLE accum_stock ADD CONSTRAINT FK_DBFE53885080ECDE FOREIGN KEY (warehouse_id) REFERENCES ref_warehouse (id)');
        $this->addSql('ALTER TABLE accum_stock_total ADD CONSTRAINT FK_222295294584665A FOREIGN KEY (product_id) REFERENCES ref_product (id)');
        $this->addSql('ALTER TABLE accum_stock_total ADD CONSTRAINT FK_222295295080ECDE FOREIGN KEY (warehouse_id) REFERENCES ref_warehouse (id)');
        $this->addSql('ALTER TABLE doc_invoice_product ADD CONSTRAINT FK_D9D4A0C47E3C61F9 FOREIGN KEY (owner_id) REFERENCES doc_invoice (id)');
        $this->addSql('ALTER TABLE doc_invoice_product ADD CONSTRAINT FK_D9D4A0C44584665A FOREIGN KEY (product_id) REFERENCES ref_product (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE post_translation ADD CONSTRAINT FK_5829CF402C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES post (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE accum_stock DROP FOREIGN KEY FK_DBFE538883D48C68');
        $this->addSql('ALTER TABLE doc_invoice_product DROP FOREIGN KEY FK_D9D4A0C47E3C61F9');
        $this->addSql('ALTER TABLE accum_stock DROP FOREIGN KEY FK_DBFE5388D4E0264C');
        $this->addSql('ALTER TABLE post_translation DROP FOREIGN KEY FK_5829CF402C2AC5D3');
        $this->addSql('ALTER TABLE accum_stock DROP FOREIGN KEY FK_DBFE53884584665A');
        $this->addSql('ALTER TABLE accum_stock_total DROP FOREIGN KEY FK_222295294584665A');
        $this->addSql('ALTER TABLE doc_invoice_product DROP FOREIGN KEY FK_D9D4A0C44584665A');
        $this->addSql('ALTER TABLE accum_stock DROP FOREIGN KEY FK_DBFE53885080ECDE');
        $this->addSql('ALTER TABLE accum_stock_total DROP FOREIGN KEY FK_222295295080ECDE');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DF675F31B');
        $this->addSql('DROP TABLE accum_stock');
        $this->addSql('DROP TABLE accum_stock_total');
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('DROP TABLE doc_invoice');
        $this->addSql('DROP TABLE doc_invoice_product');
        $this->addSql('DROP TABLE doc_order');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_translation');
        $this->addSql('DROP TABLE ref_product');
        $this->addSql('DROP TABLE ref_warehouse');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE ext_translations');
        $this->addSql('DROP TABLE ext_log_entries');
    }
}
