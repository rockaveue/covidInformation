## Laravel дээр хийсэн COVID-19 -ийн мэдээлэл харуулах вэб сайт
CS314 хичээлийн 2-р бие даалтын ажлаар уг сайтыг хийв.
COVID-19-ийн мэдээллийг [https://api.covid19api.com/](https://api.covid19api.com/) энэхүү API-с авч хийв.
Анх ороход [https://api.covid19api.com/summary](https://api.covid19api.com/summary) болон [https://api.covid19api.com/dayone/country/mongolia](https://api.covid19api.com/dayone/country/mongolia) -с мэдээллээ аван үзүүлж select option хэсгээс ямар нэгэн улсын нэрийг сонгоход тухайн улсын slug нэрээр [https://api.covid19api.com/dayone/country/{slug}](https://api.covid19api.com/dayone/country/{slug}) уг хуудас руу хүсэлт явуулж тухайн улсын мэдээллийг аван граф дээр дүрслэнэ.
Графаа Chartjs дээр байгуулав.
### CSS
Вэбээ TailwindCSS ашиглан загварчлав.
Үндсэн хуудсаа grid-ээр 6 баганад хуваан covid-ийн мэдээлэл оруулах хэсгийг 2-оос 4 дэх баганад байршуулав.