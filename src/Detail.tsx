import React, { useEffect, useState } from "react";
import { useParams } from "react-router-dom";

interface Idata{
    id:number;
    thumbnail:string;
    title:string;
    description:string;
    price:number;
}

const Detail:React.FC = () => {
  const { id } = useParams();
  const [data, setData] = useState<Idata>();
  const [load, setload] = useState<boolean>(false);
  const getSinglItem = () => {
    setload(true);
    const API = `https://afflicted-president.000webhostapp.com/first_api/read.php?id=${id}`;
    fetch(`${API}`)
      .then((res) => res.json())
      .then((data) => setData(data.data))
      .then((re) => setload(false));
  };

  // const dataMap = data.map((value) => {
  //   return (
  //     <div key={value.id}>
  //       <h1>{value.title}</h1>
  //     </div>
  //   );
  // });

  useEffect(() => {
    getSinglItem();
    console.log(data);
  }, []);
  return (
    <div className="detailPage">
      {load == false ? (
        <>
          <div className="img-wraper">
            <img src={data?.thumbnail} alt="" />
          </div>
          <div>
            <h3>{data?.title}</h3>
            <p>{data?.description}</p>

            <h1>{data?.price}$</h1>
          </div>
        </>
      ) : (
        <h1>LOADING...</h1>
      )}
    </div>
  );
};

export default Detail;
