<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210531120256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profile (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(30) DEFAULT NULL, prenom VARCHAR(30) DEFAULT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, raison_sociale VARCHAR(20) DEFAULT NULL, numero_siret INTEGER DEFAULT NULL, categorie_professionnelle VARCHAR(100) DEFAULT NULL, nombre_salarie INTEGER DEFAULT NULL, creation_entreprise DATETIME DEFAULT NULL, geolocalisation VARCHAR(100) DEFAULT NULL, numero_telephone VARCHAR(20) DEFAULT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, numero_telephone SMALLINT NOT NULL, email VARCHAR(255) NOT NULL, raison_sociale VARCHAR(20) NOT NULL, numero_siret INTEGER NOT NULL, categorie_professionelle VARCHAR(100) NOT NULL, nombre_salarie INTEGER NOT NULL, creation_entreprise VARCHAR(100) NOT NULL, geolocalisation VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE user');
    }
}
