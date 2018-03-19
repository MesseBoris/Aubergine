<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180316082201 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE commentaire (id INTEGER NOT NULL, texte CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE user ADD COLUMN plainpassword CLOB NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, email, password, roles FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER NOT NULL, username CLOB NOT NULL, email CLOB NOT NULL, password CLOB NOT NULL, roles CLOB NOT NULL --(DC2Type:json_array)
        , PRIMARY KEY(id))');
        $this->addSql('INSERT INTO user (id, username, email, password, roles) SELECT id, username, email, password, roles FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}
