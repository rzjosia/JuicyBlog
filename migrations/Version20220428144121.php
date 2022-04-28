<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428144121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT titre, auteur, date_publication, contenu FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (slug VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, auteur VARCHAR(255) NOT NULL, date_publication DATETIME NOT NULL, contenu VARCHAR(255) NOT NULL, PRIMARY KEY(slug))');
        $this->addSql('INSERT INTO article (titre, auteur, date_publication, contenu) SELECT titre, auteur, date_publication, contenu FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT titre, auteur, date_publication, contenu FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (titre VARCHAR(255) NOT NULL, auteur VARCHAR(255) NOT NULL, date_publication DATETIME NOT NULL, contenu VARCHAR(255) NOT NULL, PRIMARY KEY(titre))');
        $this->addSql('INSERT INTO article (titre, auteur, date_publication, contenu) SELECT titre, auteur, date_publication, contenu FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
    }
}
