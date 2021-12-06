<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211004091947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_C0155143A76ED395');
        $this->addSql('DROP INDEX IDX_C01551434B89032C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__blog AS SELECT id, user_id, name, body, created_at, updated_at FROM blog');
        $this->addSql('DROP TABLE blog');
        $this->addSql('CREATE TABLE blog (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, body CLOB NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, CONSTRAINT FK_C0155143A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO blog (id, user_id, name, body, created_at, updated_at) SELECT id, user_id, name, body, created_at, updated_at FROM __temp__blog');
        $this->addSql('DROP TABLE __temp__blog');
        $this->addSql('CREATE INDEX IDX_C0155143A76ED395 ON blog (user_id)');
        $this->addSql('DROP INDEX IDX_5A8A6C8DF8697D13');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, comment_id, created_at, updated_at FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, comment_id INTEGER NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, CONSTRAINT FK_5A8A6C8DF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO post (id, comment_id, created_at, updated_at) SELECT id, comment_id, created_at, updated_at FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DF8697D13 ON post (comment_id)');
        $this->addSql('DROP INDEX IDX_8D93D6494B89032C');
        $this->addSql('DROP INDEX IDX_8D93D649F8697D13');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, password, created_at, updated_at FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(255) NOT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, email VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, username, password, created_at, updated_at) SELECT id, username, password, created_at, updated_at FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_C0155143A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__blog AS SELECT id, user_id, name, body, created_at, updated_at FROM blog');
        $this->addSql('DROP TABLE blog');
        $this->addSql('CREATE TABLE blog (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, body CLOB NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, post_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO blog (id, user_id, name, body, created_at, updated_at) SELECT id, user_id, name, body, created_at, updated_at FROM __temp__blog');
        $this->addSql('DROP TABLE __temp__blog');
        $this->addSql('CREATE INDEX IDX_C0155143A76ED395 ON blog (user_id)');
        $this->addSql('CREATE INDEX IDX_C01551434B89032C ON blog (post_id)');
        $this->addSql('DROP INDEX IDX_5A8A6C8DF8697D13');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, comment_id, created_at, updated_at FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, comment_id INTEGER NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO post (id, comment_id, created_at, updated_at) SELECT id, comment_id, created_at, updated_at FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DF8697D13 ON post (comment_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, password, created_at, updated_at FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, post_id INTEGER NOT NULL, comment_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO user (id, username, password, created_at, updated_at) SELECT id, username, password, created_at, updated_at FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE INDEX IDX_8D93D6494B89032C ON user (post_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F8697D13 ON user (comment_id)');
    }
}
