<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180319160701 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE user (id INTEGER NOT NULL, username CLOB NOT NULL, email CLOB NOT NULL, password CLOB NOT NULL, roles CLOB NOT NULL --(DC2Type:json_array)
        , plainpassword CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE commentaire (id INTEGER NOT NULL, ticket_id INTEGER NOT NULL, texte CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_67F068BC700047D2 ON commentaire (ticket_id)');
        $this->addSql('CREATE TABLE ticket (id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, poste CLOB NOT NULL, description CLOB DEFAULT NULL, qualification CLOB DEFAULT NULL, etat BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_97A0ADA3A76ED395 ON ticket (user_id)');
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
