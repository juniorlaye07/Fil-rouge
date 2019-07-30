<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190730085918 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, code INT NOT NULL, montant INT NOT NULL, frais INT NOT NULL, gain INT NOT NULL, taxetat INT NOT NULL, nomcomplet VARCHAR(255) NOT NULL, tel INT NOT NULL, cin INT NOT NULL, date_envoie DATETIME NOT NULL, date_retrait DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, ninea VARCHAR(255) NOT NULL, raisonsocial VARCHAR(255) NOT NULL, tel INT NOT NULL, adresse VARCHAR(255) NOT NULL, adresse_mail VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comptbank (id INT AUTO_INCREMENT NOT NULL, id_partenaire_id INT NOT NULL, numcompte INT NOT NULL, solde INT DEFAULT NULL, INDEX IDX_9E191D5526F6C2C9 (id_partenaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, id_partenaire_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, tel INT NOT NULL, status VARCHAR(255) NOT NULL, profil VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3F85E0677 (username), INDEX IDX_1D1C63B326F6C2C9 (id_partenaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depot_argent (id INT AUTO_INCREMENT NOT NULL, comptbank_id INT NOT NULL, montant DOUBLE PRECISION NOT NULL, date_depot DATETIME NOT NULL, INDEX IDX_FD573C969731ED29 (comptbank_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comptbank ADD CONSTRAINT FK_9E191D5526F6C2C9 FOREIGN KEY (id_partenaire_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B326F6C2C9 FOREIGN KEY (id_partenaire_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE depot_argent ADD CONSTRAINT FK_FD573C969731ED29 FOREIGN KEY (comptbank_id) REFERENCES comptbank (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comptbank DROP FOREIGN KEY FK_9E191D5526F6C2C9');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B326F6C2C9');
        $this->addSql('ALTER TABLE depot_argent DROP FOREIGN KEY FK_FD573C969731ED29');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE comptbank');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE depot_argent');
    }
}
