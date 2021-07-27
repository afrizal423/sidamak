SELECT nama_pegawai, (SELECT count(*)
FROM `pegawai` as pg
inner join keluhan_pegawai as kp
on pg.id = kp.id_pegawai
inner join keluhan as k
on kp.id_keluhan = k.id
where pgw.id = pg.id
and k.status = 1 and k.is_approv = 1 and k.is_done_solusi = 1) as selesai ,
(SELECT count(*)
FROM `pegawai` as pg
inner join keluhan_pegawai as kp
on pg.id = kp.id_pegawai
inner join keluhan as k
on kp.id_keluhan = k.id
where pgw.id = pg.id
and k.status = 3 and k.is_approv = 0 and k.is_done_solusi = 1) as pending ,
(SELECT count(*)
FROM `pegawai` as pg
inner join keluhan_pegawai as kp
on pg.id = kp.id_pegawai
inner join keluhan as k
on kp.id_keluhan = k.id
where pgw.id = pg.id
and k.status = 2) as progress
FROM `pegawai` as pgw
ORDER BY `progress`  DESC
