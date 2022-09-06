//DIVISION RULE BASE

@if($data['division_id'] == 2)
    Johor,
@elseif($data['division_id'] == 3)
    Sabah,
@elseif($data['division_id'] == 4)
    Sarawak,
@elseif($data['division_id'] == 5)
    Kedah,
@elseif($data['division_id'] == 6)
    Kelantan,
@elseif($data['division_id'] == 7)
    Melaka,
@elseif($data['division_id'] == 8)
    Negeri Sembilan,
@elseif($data['division_id'] == 9)
    Pahang,
@elseif($data['division_id'] == 10)
    Perak,
@elseif($data['division_id'] == 11)
    Perlis,
@elseif($data['division_id'] == 12)
    Pulau Pinang,
@elseif($data['division_id'] == 13)
    Terengganu,
@elseif($data['division_id'] == 14)
    Selangor,
@else
    Wilayah Persekutuan,
@endif