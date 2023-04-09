import { Injectable } from '@angular/core';
import { ApiService } from './api.service';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class EventApiService extends ApiService {

  getEvents(date: string = ''): Observable<any> {
    return this.get(`/events?date=${date}`);
  }

  getEvent(id: string):  Observable<any> {
    return this.get(`/events/${id}`);
  }

  updateEvent(id: string, event: any) {
    return this.post(`/events/${id}`, event);
  }

  updateEventClassroom(id: string, classroomId: string) {
    return this.post(`/events/update-classroom/${id}/${classroomId}`);
  }

  updateEventTeacher(id: string, teacherId: string) {
    return this.post(`/events/update-teacher/${id}/${teacherId}`);
  }

  createEvent(event: any) {
    return this.post(`/events`, event);
  }

  getEventTypes(): Observable<any> {
    return this.get('/event-type');
  }
}
