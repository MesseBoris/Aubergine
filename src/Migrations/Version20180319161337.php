<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180319161337 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_97A0ADA3A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ticket AS SELECT id, user_id, poste, description, etat FROM ticket');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('CREATE TABLE ticket (id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, poste CLOB NOT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, etat BOOLEAN NOT NULL, qualification CLOB DEFAULT NULL, prequalification CLOB DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_97A0ADA3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ticket (id, user_id, poste, description, etat) SELECT id, user_id, poste, description, etat FROM __temp__ticket');
        $this->addSql('DROP TABLE __temp__ticket');
        $this->addSql('CREATE INDEX IDX_97A0ADA3A76ED395 ON ticket (user_id)');
        $this->addSql('DROP INDEX IDX_67F068BC700047D2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, ticket_id, texte FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER NOT NULL, ticket_id INTEGER NOT NULL, texte CLOB NOT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_67F068BC700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commentaire (id, ticket_id, texte) SELECT id, ticket_id, texte FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BC700047D2 ON commentaire (ticket_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_67F068BC700047D2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, ticket_id, texte FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER NOT NULL, ticket_id INTEGER NOT NULL, texte CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO commentaire (id, ticket_id, texte) SELECT id, ticket_id, texte FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BC700047D2 ON commentaire (ticket_id)');
        $this->addSql('DROP INDEX IDX_97A0ADA3A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ticket AS SELECT id, user_id, poste, description, etat FROM ticket');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('CREATE TABLE ticket (id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, poste CLOB NOT NULL, description CLOB DEFAULT NULL, etat BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO ticket (id, user_id, poste, description, etat) SELECT id, user_id, poste, description, etat FROM __temp__ticket');
        $this->addSql('DROP TABLE __temp__ticket');
        $this->addSql('CREATE INDEX IDX_97A0ADA3A76ED395 ON ticket (user_id)');
    }
}
