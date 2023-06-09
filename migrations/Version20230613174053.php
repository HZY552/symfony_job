<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230613174053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CCCFA12B8');
        $this->addSql('DROP INDEX IDX_9474526CCCFA12B8 ON comment');
        $this->addSql('ALTER TABLE comment DROP profile_id, DROP content, DROP create_date, DROP user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD profile_id INT NOT NULL, ADD content LONGTEXT NOT NULL, ADD create_date DATE NOT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CCCFA12B8 FOREIGN KEY (profile_id) REFERENCES freelancer_profile (id)');
        $this->addSql('CREATE INDEX IDX_9474526CCCFA12B8 ON comment (profile_id)');
    }
}
