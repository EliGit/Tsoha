use testDB1;

INSERT INTO customerhour SET id=1, day=Date('2014-01-01'), customer="Le Company1", description= "vamonos", hours=5, offhours=2, deleted=0;
INSERT INTO customerhour SET id=2, day=Date('2014-01-02'), customer="Le Company2", description= "alles gut", hours=5, offhours=2, deleted=0;
INSERT INTO customerhour SET id=3, day=Date('2014-01-03'), customer="Le Company3", description= "ce la vie", hours=5, offhours=2, deleted=0;

INSERT INTO user SET username="user1", password="user1",firstname="Jari",lastname="Virtanen",address="Katu 16, 00100, Helsinki",email="email@email.com",phone="123456789",rank=0;
INSERT INTO user SET username="user2", password="user2",firstname="Kari",lastname="Virtanen",address="Katu 16, 00100, Helsinki",email="email1@email.com",phone="987654321",rank=0;

INSERT INTO customerHourWorkers SET customerHour_id=1 ,user_id =1;
INSERT INTO customerHourWorkers SET customerHour_id=2 ,user_id =1;
INSERT INTO customerHourWorkers SET customerHour_id=1 ,user_id =2;
INSERT INTO customerHourWorkers SET customerHour_id=2 ,user_id =2;

INSERT INTO workhour SET id=1,day=Date('2014-01-01'), hours=4,offhours=1,standbyhours=0,deleted=0, user_id=1;
INSERT INTO workhour SET id=2,day=Date('2014-01-02'), hours=4,offhours=1,standbyhours=0,deleted=0, user_id=1;
INSERT INTO workhour SET id=3,day=Date('2014-01-03'), hours=4,offhours=1,standbyhours=0,deleted=0, user_id=1;
