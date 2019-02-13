<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190213090101 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE livres (id INT AUTO_INCREMENT NOT NULL, categories_id INT DEFAULT NULL, emprunteur_id INT DEFAULT NULL, library_id INT NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, resume LONGTEXT NOT NULL, edition VARCHAR(255) NOT NULL, date DATE NOT NULL, date_borrowing DATE DEFAULT NULL, date_return DATE DEFAULT NULL, status TINYINT(1) NOT NULL, INDEX IDX_927187A4A21214B7 (categories_id), INDEX IDX_927187A4F0840037 (emprunteur_id), INDEX IDX_927187A4FE2541D7 (library_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, library_id INT NOT NULL, user_name VARCHAR(255) NOT NULL, user_key INT NOT NULL, librarian VARCHAR(255) NOT NULL, INDEX IDX_8D93D649FE2541D7 (library_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE library (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livres ADD CONSTRAINT FK_927187A4A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE livres ADD CONSTRAINT FK_927187A4F0840037 FOREIGN KEY (emprunteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE livres ADD CONSTRAINT FK_927187A4FE2541D7 FOREIGN KEY (library_id) REFERENCES library (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FE2541D7 FOREIGN KEY (library_id) REFERENCES library (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE livres DROP FOREIGN KEY FK_927187A4A21214B7');
        $this->addSql('ALTER TABLE livres DROP FOREIGN KEY FK_927187A4F0840037');
        $this->addSql('ALTER TABLE livres DROP FOREIGN KEY FK_927187A4FE2541D7');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FE2541D7');
        $this->addSql('DROP TABLE livres');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE library');
    }
}
