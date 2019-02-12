<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190212150014 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE livres ADD emprunteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livres ADD CONSTRAINT FK_927187A4F0840037 FOREIGN KEY (emprunteur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_927187A4F0840037 ON livres (emprunteur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE livres DROP FOREIGN KEY FK_927187A4F0840037');
        $this->addSql('DROP INDEX IDX_927187A4F0840037 ON livres');
        $this->addSql('ALTER TABLE livres DROP emprunteur_id');
    }
}
