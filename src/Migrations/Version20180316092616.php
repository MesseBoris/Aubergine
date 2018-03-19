<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180316092616 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE user (id INTEGER NOT NULL, username CLOB NOT NULL, email CLOB NOT NULL, password CLOB NOT NULL, roles CLOB NOT NULL --(DC2Type:json_array)
        , plainpassword CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE commentaire (id INTEGER NOT NULL, texte CLOB NOT NULL, id_ticket INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ticket (id INTEGER NOT NULL, poste CLOB NOT NULL, description CLOB DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE ticket');
    }
}
