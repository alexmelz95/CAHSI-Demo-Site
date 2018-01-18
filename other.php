DELIMITER $$
CREATE TRIGGER before_STUDENT_update
    BEFORE UPDATE ON STUDENT
    FOR EACH ROW
BEGIN
    INSERT INTO HAS
    SET action = 'update',
    HAS.Sid = STUDENT.Sid,
    HAS.Fid = FACULTY.Fid, //student picks mentor from FACULTY table when registering for portal and we take the id from the mentor they pick
END$$
DELIMITER ;