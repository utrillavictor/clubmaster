<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20111211164308 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("CREATE TABLE club_team_schedule_field (schedule_id INT NOT NULL, field_id INT NOT NULL, INDEX IDX_50250385A40BC2D5 (schedule_id), INDEX IDX_50250385443707B0 (field_id), PRIMARY KEY(schedule_id, field_id)) ENGINE = InnoDB");
        $this->addSql("CREATE TABLE club_booking_field (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, position INT NOT NULL, information LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_774EFE5964D218E (location_id), PRIMARY KEY(id)) ENGINE = InnoDB");
        $this->addSql("CREATE TABLE club_booking_booking (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, interval_id INT DEFAULT NULL, date DATE NOT NULL, guest TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A5A49A20A76ED395 (user_id), INDEX IDX_A5A49A20505A342E (interval_id), UNIQUE INDEX unique_idx (date, interval_id), PRIMARY KEY(id)) ENGINE = InnoDB");
        $this->addSql("CREATE TABLE club_booking_booking_user (booking_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_CE8B35863301C60 (booking_id), INDEX IDX_CE8B3586A76ED395 (user_id), PRIMARY KEY(booking_id, user_id)) ENGINE = InnoDB");
        $this->addSql("CREATE TABLE club_booking_interval (id INT AUTO_INCREMENT NOT NULL, field_id INT DEFAULT NULL, day INT NOT NULL, start_time TIME NOT NULL, stop_time TIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_438698A7443707B0 (field_id), PRIMARY KEY(id)) ENGINE = InnoDB");
        $this->addSql("ALTER TABLE club_team_schedule_field ADD CONSTRAINT FK_50250385A40BC2D5 FOREIGN KEY (schedule_id) REFERENCES club_team_schedule(id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE club_team_schedule_field ADD CONSTRAINT FK_50250385443707B0 FOREIGN KEY (field_id) REFERENCES club_booking_field(id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE club_booking_field ADD CONSTRAINT FK_774EFE5964D218E FOREIGN KEY (location_id) REFERENCES club_user_location(id)");
        $this->addSql("ALTER TABLE club_booking_booking ADD CONSTRAINT FK_A5A49A20A76ED395 FOREIGN KEY (user_id) REFERENCES club_user_user(id)");
        $this->addSql("ALTER TABLE club_booking_booking ADD CONSTRAINT FK_A5A49A20505A342E FOREIGN KEY (interval_id) REFERENCES club_booking_interval(id)");
        $this->addSql("ALTER TABLE club_booking_booking_user ADD CONSTRAINT FK_CE8B35863301C60 FOREIGN KEY (booking_id) REFERENCES club_booking_booking(id)");
        $this->addSql("ALTER TABLE club_booking_booking_user ADD CONSTRAINT FK_CE8B3586A76ED395 FOREIGN KEY (user_id) REFERENCES club_user_user(id)");
        $this->addSql("ALTER TABLE club_booking_interval ADD CONSTRAINT FK_438698A7443707B0 FOREIGN KEY (field_id) REFERENCES club_booking_field(id)");
        $this->addSql("ALTER TABLE club_team_schedule_user DROP FOREIGN KEY FK_860A2A86A76ED395");
        $this->addSql("ALTER TABLE club_team_schedule_user DROP FOREIGN KEY FK_860A2A86A40BC2D5");
        $this->addSql("ALTER TABLE club_team_schedule_user DROP PRIMARY KEY");
        $this->addSql("ALTER TABLE club_team_schedule_user ADD id INT AUTO_INCREMENT NOT NULL PRIMARY KEY, ADD created_at DATETIME NOT NULL, CHANGE schedule_id schedule_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE club_team_schedule_user ADD CONSTRAINT FK_860A2A86A76ED395 FOREIGN KEY (user_id) REFERENCES club_user_user(id)");
        $this->addSql("ALTER TABLE club_team_schedule_user ADD CONSTRAINT FK_860A2A86A40BC2D5 FOREIGN KEY (schedule_id) REFERENCES club_team_schedule(id)");
        $this->addSql("CREATE UNIQUE INDEX unique_idx ON club_team_schedule_user (user_id, schedule_id)");
        #$this->addSql("ALTER TABLE club_team_schedule_user ADD PRIMARY KEY (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("ALTER TABLE club_team_schedule_field DROP FOREIGN KEY FK_50250385443707B0");
        $this->addSql("ALTER TABLE club_booking_interval DROP FOREIGN KEY FK_438698A7443707B0");
        $this->addSql("ALTER TABLE club_booking_booking_user DROP FOREIGN KEY FK_CE8B35863301C60");
        $this->addSql("ALTER TABLE club_booking_booking DROP FOREIGN KEY FK_A5A49A20505A342E");
        $this->addSql("DROP TABLE club_team_schedule_field");
        $this->addSql("DROP TABLE club_booking_field");
        $this->addSql("DROP TABLE club_booking_booking");
        $this->addSql("DROP TABLE club_booking_booking_user");
        $this->addSql("DROP TABLE club_booking_interval");
        $this->addSql("ALTER TABLE club_team_schedule_user DROP FOREIGN KEY FK_860A2A86A76ED395");
        $this->addSql("ALTER TABLE club_team_schedule_user DROP FOREIGN KEY FK_860A2A86A40BC2D5");
        $this->addSql("DROP INDEX unique_idx ON club_team_schedule_user");
        $this->addSql("ALTER TABLE club_team_schedule_user DROP PRIMARY KEY");
        $this->addSql("ALTER TABLE club_team_schedule_user DROP id, DROP created_at, CHANGE user_id user_id INT NOT NULL, CHANGE schedule_id schedule_id INT NOT NULL");
        $this->addSql("ALTER TABLE club_team_schedule_user ADD CONSTRAINT FK_860A2A86A76ED395 FOREIGN KEY (user_id) REFERENCES club_user_user(id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE club_team_schedule_user ADD CONSTRAINT FK_860A2A86A40BC2D5 FOREIGN KEY (schedule_id) REFERENCES club_team_schedule(id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE club_team_schedule_user ADD PRIMARY KEY (schedule_id, user_id)");
    }
}