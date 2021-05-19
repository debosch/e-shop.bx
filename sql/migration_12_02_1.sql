create procedure zaliv()
begin
	declare i int;
	set i = 1;
	while (i <= 25)
		do
			insert into item_tag(item_id, tag_id)
			value (i, 1);
			set i = i + 1;
		end while;
end;

drop procedure zaliv;

call zaliv();


