import React from "react";
import { useEffect, useState } from "react";
import "./App.css";
import { Link } from "react-router-dom";


interface Idata{
    id:number;
    thumbnail:string;
    title:string;
    description:string;
    price:number;
}

const Home:React.FC = () => {
  const API =
    "https://afflicted-president.000webhostapp.com/first_api/read.php";
  const [data, SetData] = useState<Idata[]>([]);
  const [search, Setsearch] = useState<string>("");
  const [load, setLoad] = useState<boolean>(false);

  //Fetch Data From Api
  const getData = async () => {
    setLoad(true);
    const fetchdata = await fetch(API);
    const data = await fetchdata.json();
    SetData(data.data);
    setLoad(false);
  };

  const searchItem = (param:string) => {
    fetch(
      `https://afflicted-president.000webhostapp.com/first_api/read.php?title=${param}`
    )
      .then((res) => res.json())
      .then((data) => SetData(data.data as Idata[]));
  };

  const Data = data?.map((item) => {
    return (
      <div className="product" key={item.id}>
        <Link to={`detail/${item.id}`}>
          <img src={item.thumbnail} alt={item.title} />
          <h5>{item.title}</h5>
          <p>{item.description.substring(0, 50)}...</p>
          <p>{item.price}$</p>
        </Link>
      </div>
    );
  });
  useEffect(() => {
    // fetch(API)
    //   .then((res) => res.json())
    //   .then((data) => console.log(data.products));
    //Fetch Data Fuvction
    if (search) {
      let timer1 = setTimeout(() => {
        searchItem(search);
      }, 500);

      return () => {
        clearTimeout(timer1);
      };
    } else {
      getData();
    }
  }, [search, Setsearch]);

  return (
    <div className="home">
      <input
        placeholder="Search In Products"
        style={{
          padding: "15px 10px",
          fontSize: "20px",
          outline: "none",
        }}
        type="search"
        value={search}
        onChange={(e) => Setsearch(e.target.value)}
      />
      {load ? <h2>LOADING...</h2> : null}

      {data && data.length > 0 ? (
        <div className="products">{Data}</div>
      ) : (
        <h5>NO DATA TO SHOW </h5>
      )}
    </div>
  );
};

export default Home;
