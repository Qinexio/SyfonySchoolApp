<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191111141706 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE score ADD score_user_id INT NOT NULL, ADD score_test_id INT NOT NULL');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751C6E6F601 FOREIGN KEY (score_user_id) REFERENCES user_base (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937517FD521CD FOREIGN KEY (score_test_id) REFERENCES test_base (id)');
        $this->addSql('CREATE INDEX IDX_32993751C6E6F601 ON score (score_user_id)');
        $this->addSql('CREATE INDEX IDX_329937517FD521CD ON score (score_test_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751C6E6F601');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_329937517FD521CD');
        $this->addSql('DROP INDEX IDX_32993751C6E6F601 ON score');
        $this->addSql('DROP INDEX IDX_329937517FD521CD ON score');
        $this->addSql('ALTER TABLE score DROP score_user_id, DROP score_test_id');
    }
}
