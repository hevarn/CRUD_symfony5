<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210607135242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__profile AS SELECT id, nom, prenom, email, password, raison_sociale, numero_siret, categorie_professionnelle, nombre_salarie, creation_entreprise, geolocalisation, numero_telephone FROM profile');
        $this->addSql('DROP TABLE profile');
        $this->addSql('CREATE TABLE profile (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(30) DEFAULT NULL COLLATE BINARY, prenom VARCHAR(30) DEFAULT NULL COLLATE BINARY, email VARCHAR(100) NOT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL COLLATE BINARY, raison_sociale VARCHAR(20) DEFAULT NULL COLLATE BINARY, numero_siret INTEGER DEFAULT NULL, categorie_professionnelle VARCHAR(100) DEFAULT NULL COLLATE BINARY, nombre_salarie INTEGER DEFAULT NULL, creation_entreprise VARCHAR(100) DEFAULT NULL COLLATE BINARY, geolocalisation VARCHAR(100) DEFAULT NULL COLLATE BINARY, numero_telephone VARCHAR(20) DEFAULT NULL COLLATE BINARY, user_image VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO profile (id, nom, prenom, email, password, raison_sociale, numero_siret, categorie_professionnelle, nombre_salarie, creation_entreprise, geolocalisation, numero_telephone) SELECT id, nom, prenom, email, password, raison_sociale, numero_siret, categorie_professionnelle, nombre_salarie, creation_entreprise, geolocalisation, numero_telephone FROM __temp__profile');
        $this->addSql('DROP TABLE __temp__profile');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8157AA0FE7927C74 ON profile (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(30) NOT NULL COLLATE BINARY, prenom VARCHAR(30) NOT NULL COLLATE BINARY, numero_telephone SMALLINT NOT NULL, email VARCHAR(255) NOT NULL COLLATE BINARY, raison_sociale VARCHAR(20) NOT NULL COLLATE BINARY, numero_siret INTEGER NOT NULL, categorie_professionelle VARCHAR(100) NOT NULL COLLATE BINARY, nombre_salarie INTEGER NOT NULL, creation_entreprise VARCHAR(100) NOT NULL COLLATE BINARY, geolocalisation VARCHAR(100) NOT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('DROP INDEX UNIQ_8157AA0FE7927C74');
        $this->addSql('CREATE TEMPORARY TABLE __temp__profile AS SELECT id, nom, prenom, email, password, raison_sociale, numero_siret, categorie_professionnelle, nombre_salarie, creation_entreprise, geolocalisation, numero_telephone FROM profile');
        $this->addSql('DROP TABLE profile');
        $this->addSql('CREATE TABLE profile (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(30) DEFAULT NULL, prenom VARCHAR(30) DEFAULT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, raison_sociale VARCHAR(20) DEFAULT NULL, numero_siret INTEGER DEFAULT NULL, categorie_professionnelle VARCHAR(100) DEFAULT NULL, nombre_salarie INTEGER DEFAULT NULL, creation_entreprise VARCHAR(100) DEFAULT NULL, geolocalisation VARCHAR(100) DEFAULT NULL, numero_telephone VARCHAR(20) DEFAULT NULL)');
        $this->addSql('INSERT INTO profile (id, nom, prenom, email, password, raison_sociale, numero_siret, categorie_professionnelle, nombre_salarie, creation_entreprise, geolocalisation, numero_telephone) SELECT id, nom, prenom, email, password, raison_sociale, numero_siret, categorie_professionnelle, nombre_salarie, creation_entreprise, geolocalisation, numero_telephone FROM __temp__profile');
        $this->addSql('DROP TABLE __temp__profile');
    }
}
