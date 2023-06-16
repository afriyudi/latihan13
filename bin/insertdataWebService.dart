// ignore: file_names
import 'dart:async';
import 'dart:convert';

import 'package:http/http.dart' as http;

Future<List<Users>> fetchUsers() async {
  final response =
      await http.get(Uri.parse('http://localhost/webservice/mysqltest.php'));

  if (response.statusCode == 200) {
    // If the server did return a 200 OK response,
    // then parse the JSON.
    var message = jsonDecode(response.body).cast<Map<String, dynamic>>();

    // print(message);
    return message.map<Users>((json) => Users.fromJson(json)).toList();
  } else {
    // If the server did not return a 200 OK response,
    // then throw an exception.
    throw Exception('Failed to load Users');
  }
}

Future quaryWSUsers(
    {String iddata = '0',
    String name = '',
    String email = '',
    String age = '',
    String tanda = '3'}) async {
  // API URL
  var url = 'http://localhost/webservice/mywebservices.php';

  // Store all data with Param Name.
  // tanda=0   insert
  // tanda=1   update
  // tanda=2   delete
  // tanda=3   select All

  var data = {
    "tanda": tanda,
    "iddata": iddata,
    "name": name,
    "email": email,
    "age": age,
  };

  // Starting Web Call with data.
  var response = await http.post(Uri.parse(url), body: json.encode(data));

  // Getting Server response into variable.
//  var message = jsonDecode(response.body);

  if (response.statusCode == 200) {
    // If the server did return a 200 OK response,
    // then parse the JSON.
    print(response.body);
  } else {
    // If the server did not return a 200 OK response,
    // then throw an exception.
    throw Exception('Failed to load Users');
  }
}

class Users {
  final String id;
  final String name;
  final String email;
  final String age;

  Users({
    required this.id,
    required this.name,
    required this.email,
    required this.age,
  });

  factory Users.fromJson(Map<String, dynamic> json) {
    return Users(
      id: json['id'],
      name: json['name'],
      email: json['email'],
      age: json['age'],
    );
  }
}

Future<void> main() async {
  List<Users> futureUsers;
  futureUsers = await fetchUsers();
  print(futureUsers.length);
  for (var data in futureUsers) {
    print("${data.id} : ${data.name} : ${data.email} : ${data.age} : ");
  }

  print("============");

  await quaryWSUsers(
      tanda: "3",
      iddata: "2",
      name: "Sulaiman",
      email: "sulaiman@yahoo.com",
      age: "42");

  futureUsers = await fetchUsers();
  print(futureUsers.length);
  for (var data in futureUsers) {
    print("${data.id} : ${data.name} : ${data.email} : ${data.age} : ");
  }
}
