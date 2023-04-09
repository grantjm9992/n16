import {Injectable} from "@angular/core";

@Injectable({
  providedIn: 'root'
})
export class UserService {
  getUser() {
    let user = localStorage.getItem('user');
    if (user != null) {
      return JSON.parse(user);
    }
  }
}
