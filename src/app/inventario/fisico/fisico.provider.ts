import { ULRProvider } from './../../providers/url.providers';
import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import 'rxjs/add/operator/map';

@Injectable()
export class  FisicoProvider {

  constructor(
    private http: Http,
    private urlProvider: ULRProvider) {}

  public all() {
    return this.http.get(this.urlProvider.getAllFisico())
      .map((res: Response) => res.json());
  }

  public getByLocalProducto(objeto: any) {
    return this.http.post(this.urlProvider.getFisicoByLocalProducto(), JSON.stringify(objeto), {
      headers: new Headers({ 'Content-Type': 'application/json' })
    })
      .map((resp: Response) => resp);
  }

  public insert(objeto: any) {
    return this.http.post(this.urlProvider.insertFisico(), JSON.stringify(objeto), {
      headers: new Headers({ 'Content-Type': 'application/json' })
    })
      .map((resp: Response) => resp);
  }

  public update(objeto: Object) {
    return this.http.post(this.urlProvider.updateFisico(), JSON.stringify(objeto), {
      headers: new Headers({ 'Content-type': 'application/json' })
      })
      .map((resp: Response) => resp);
  }

  public delete(objeto: any) {
    return this.http.post(this.urlProvider.deleteFisico(), JSON.stringify(objeto), {
      headers: new Headers({ 'Content-Type': 'application/json' })
    })
      .map((resp: Response) => resp);
  }

  public getAllLocales() {
    return this.http.get(this.urlProvider.getAllLocales())
      .map((res: Response) => res.json());
  }

  public getAllProductos() {
    return this.http.get(this.urlProvider.getAllProductos())
      .map((res: Response) => res.json());
  }

}
