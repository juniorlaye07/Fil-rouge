<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190729112233 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comptbank ADD id_partenaire_id INT NOT NULL');
        $this->addSql('ALTER TABLE comptbank ADD CONSTRAINT FK_9E191D5526F6C2C9 FOREIGN KEY (id_partenaire_id) REFERENCES partenaire (id)');
        $this->addSql('CREATE INDEX IDX_9E191D5526F6C2C9 ON comptbank (id_partenaire_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comptbank DROP FOREIGN KEY FK_9E191D5526F6C2C9');
        $this->addSql('DROP INDEX IDX_9E191D5526F6C2C9 ON comptbank');
        $this->addSql('ALTER TABLE comptbank DROP id_partenaire_id');
    }
}
