<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240311194145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE player_quest_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE quest_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE player_quest (id INT NOT NULL, target_id INT NOT NULL, quest_id INT NOT NULL, player_id INT NOT NULL, valid BOOLEAN DEFAULT false NOT NULL, validated_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FC658351158E0B66 ON player_quest (target_id)');
        $this->addSql('CREATE INDEX IDX_FC658351209E9EF4 ON player_quest (quest_id)');
        $this->addSql('CREATE INDEX IDX_FC65835199E6F5DF ON player_quest (player_id)');
        $this->addSql('CREATE TABLE quest (id INT NOT NULL, content TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE player_quest ADD CONSTRAINT FK_FC658351158E0B66 FOREIGN KEY (target_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_quest ADD CONSTRAINT FK_FC658351209E9EF4 FOREIGN KEY (quest_id) REFERENCES quest (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_quest ADD CONSTRAINT FK_FC65835199E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE player_quest_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE quest_id_seq CASCADE');
        $this->addSql('ALTER TABLE player_quest DROP CONSTRAINT FK_FC658351158E0B66');
        $this->addSql('ALTER TABLE player_quest DROP CONSTRAINT FK_FC658351209E9EF4');
        $this->addSql('ALTER TABLE player_quest DROP CONSTRAINT FK_FC65835199E6F5DF');
        $this->addSql('DROP TABLE player_quest');
        $this->addSql('DROP TABLE quest');
    }
}
