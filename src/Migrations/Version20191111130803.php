<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191111130803 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_base (id INT AUTO_INCREMENT NOT NULL, user_detail_id INT NOT NULL, user_password_id INT NOT NULL, user_name VARCHAR(32) NOT NULL, UNIQUE INDEX UNIQ_BA35B2A8D8308E5F (user_detail_id), UNIQUE INDEX UNIQ_BA35B2A89751B054 (user_password_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_base_user_role (user_base_id INT NOT NULL, user_role_id INT NOT NULL, INDEX IDX_F5418877316AC14B (user_base_id), INDEX IDX_F54188778E0E3CA6 (user_role_id), PRIMARY KEY(user_base_id, user_role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_detail (id INT AUTO_INCREMENT NOT NULL, user_email VARCHAR(255) NOT NULL, user_valid TINYINT(1) NOT NULL, user_key VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_password (id INT AUTO_INCREMENT NOT NULL, user_pass_hash VARCHAR(64) NOT NULL, user_pass_salt VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_role (id INT AUTO_INCREMENT NOT NULL, user_permision VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_base ADD CONSTRAINT FK_BA35B2A8D8308E5F FOREIGN KEY (user_detail_id) REFERENCES user_detail (id)');
        $this->addSql('ALTER TABLE user_base ADD CONSTRAINT FK_BA35B2A89751B054 FOREIGN KEY (user_password_id) REFERENCES user_password (id)');
        $this->addSql('ALTER TABLE user_base_user_role ADD CONSTRAINT FK_F5418877316AC14B FOREIGN KEY (user_base_id) REFERENCES user_base (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_base_user_role ADD CONSTRAINT FK_F54188778E0E3CA6 FOREIGN KEY (user_role_id) REFERENCES user_role (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_base_user_role DROP FOREIGN KEY FK_F5418877316AC14B');
        $this->addSql('ALTER TABLE user_base DROP FOREIGN KEY FK_BA35B2A8D8308E5F');
        $this->addSql('ALTER TABLE user_base DROP FOREIGN KEY FK_BA35B2A89751B054');
        $this->addSql('ALTER TABLE user_base_user_role DROP FOREIGN KEY FK_F54188778E0E3CA6');
        $this->addSql('DROP TABLE user_base');
        $this->addSql('DROP TABLE user_base_user_role');
        $this->addSql('DROP TABLE user_detail');
        $this->addSql('DROP TABLE user_password');
        $this->addSql('DROP TABLE user_role');
    }
}
